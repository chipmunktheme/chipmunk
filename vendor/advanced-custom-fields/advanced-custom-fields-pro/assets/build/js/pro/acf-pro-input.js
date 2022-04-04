/** *** */ (function() { // webpackBootstrap
/** *** */ 	const __webpack_modules__ = ({

/***/ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-field-flexible-content.js":
/*! *****************************************************************************************!*\
  !*** ./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-field-flexible-content.js ***!
  \**************************************************************************************** */
/***/ (function() {

(function ($) {
  const Field = acf.Field.extend({
    type: 'flexible_content',
    wait: '',
    events: {
      'click [data-name="add-layout"]': 'onClickAdd',
      'click [data-name="duplicate-layout"]': 'onClickDuplicate',
      'click [data-name="remove-layout"]': 'onClickRemove',
      'click [data-name="collapse-layout"]': 'onClickCollapse',
      showField: 'onShow',
      unloadField: 'onUnload',
      mouseover: 'onHover'
    },
    $control () {
      return this.$('.acf-flexible-content:first');
    },
    $layoutsWrap () {
      return this.$('.acf-flexible-content:first > .values');
    },
    $layouts () {
      return this.$('.acf-flexible-content:first > .values > .layout');
    },
    $layout (index) {
      return this.$(`.acf-flexible-content:first > .values > .layout:eq(${  index  })`);
    },
    $clonesWrap () {
      return this.$('.acf-flexible-content:first > .clones');
    },
    $clones () {
      return this.$('.acf-flexible-content:first > .clones  > .layout');
    },
    $clone (name) {
      return this.$(`.acf-flexible-content:first > .clones  > .layout[data-layout="${  name  }"]`);
    },
    $actions () {
      return this.$('.acf-actions:last');
    },
    $button () {
      return this.$('.acf-actions:last .button');
    },
    $popup () {
      return this.$('.tmpl-popup:last');
    },
    getPopupHTML () {
      // vars
      let html = this.$popup().html();
      const $html = $(html); // count layouts

      const $layouts = this.$layouts();

      const countLayouts = function (name) {
        return $layouts.filter(function () {
          return $(this).data('layout') === name;
        }).length;
      }; // modify popup


      $html.find('[data-layout]').each(function () {
        // vars
        const $a = $(this);
        const min = $a.data('min') || 0;
        const max = $a.data('max') || 0;
        const name = $a.data('layout') || '';
        const count = countLayouts(name); // max

        if (max && count >= max) {
          $a.addClass('disabled');
          return;
        } // min


        if (min && count < min) {
          // vars
          const required = min - count;

          let title = acf.__('{required} {label} {identifier} required (min {min})');

          const identifier = acf._n('layout', 'layouts', required); // translate


          title = title.replace('{required}', required);
          title = title.replace('{label}', name); // 5.5.0

          title = title.replace('{identifier}', identifier);
          title = title.replace('{min}', min); // badge

          $a.append(`<span class="badge" title="${  title  }">${  required  }</span>`);
        }
      }); // update

      html = $html.outerHTML(); // return

      return html;
    },
    getValue () {
      return this.$layouts().length;
    },
    allowRemove () {
      const min = parseInt(this.get('min'));
      return !min || min < this.val();
    },
    allowAdd () {
      const max = parseInt(this.get('max'));
      return !max || max > this.val();
    },
    isFull () {
      const max = parseInt(this.get('max'));
      return max && this.val() >= max;
    },
    addSortable (self) {
      // bail early if max 1 row
      if (this.get('max') == 1) {
        return;
      } // add sortable


      this.$layoutsWrap().sortable({
        items: '> .layout',
        handle: '> .acf-fc-layout-handle',
        forceHelperSize: true,
        forcePlaceholderSize: true,
        scroll: true,
        stop (event, ui) {
          self.render();
        },
        update (event, ui) {
          self.$input().trigger('change');
        }
      });
    },
    addCollapsed () {
      // vars
      const indexes = preference.load(this.get('key')); // bail early if no collapsed

      if (!indexes) {
        return false;
      } // loop


      this.$layouts().each(function (i) {
        if (indexes.indexOf(i) > -1) {
          $(this).addClass('-collapsed');
        }
      });
    },
    addUnscopedEvents (self) {
      // invalidField
      this.on('invalidField', '.layout', function (e) {
        self.onInvalidField(e, $(this));
      });
    },
    initialize () {
      // add unscoped events
      this.addUnscopedEvents(this); // add collapsed

      this.addCollapsed(); // disable clone

      acf.disable(this.$clonesWrap(), this.cid); // render

      this.render();
    },
    render () {
      // update order number
      this.$layouts().each(function (i) {
        $(this).find('.acf-fc-layout-order:first').html(i + 1);
      }); // empty

      if (this.val() == 0) {
        this.$control().addClass('-empty');
      } else {
        this.$control().removeClass('-empty');
      } // max


      if (this.isFull()) {
        this.$button().addClass('disabled');
      } else {
        this.$button().removeClass('disabled');
      }
    },
    onShow (e, $el, context) {
      // get sub fields
      const fields = acf.getFields({
        is: ':visible',
        parent: this.$el
      }); // trigger action
      // - ignore context, no need to pass through 'conditional_logic'
      // - this is just for fields like google_map to render itself

      acf.doAction('show_fields', fields);
    },
    validateAdd () {
      // return true if allowed
      if (this.allowAdd()) {
        return true;
      } // vars


      const max = this.get('max');

      let text = acf.__('This field has a limit of {max} {label} {identifier}');

      const identifier = acf._n('layout', 'layouts', max); // replace


      text = text.replace('{max}', max);
      text = text.replace('{label}', '');
      text = text.replace('{identifier}', identifier); // add notice

      this.showNotice({
        text,
        type: 'warning'
      }); // return

      return false;
    },
    onClickAdd (e, $el) {
      // validate
      if (!this.validateAdd()) {
        return false;
      } // within layout


      let $layout = null;

      if ($el.hasClass('acf-icon')) {
        $layout = $el.closest('.layout');
        $layout.addClass('-hover');
      } // new popup


      const popup = new Popup({
        target: $el,
        targetConfirm: false,
        text: this.getPopupHTML(),
        context: this,
        confirm (e, $el) {
          // check disabled
          if ($el.hasClass('disabled')) {
            return;
          } // add


          this.add({
            layout: $el.data('layout'),
            before: $layout
          });
        },
        cancel () {
          if ($layout) {
            $layout.removeClass('-hover');
          }
        }
      }); // add extra event

      popup.on('click', '[data-layout]', 'onConfirm');
    },
    add (args) {
      // defaults
      args = acf.parseArgs(args, {
        layout: '',
        before: false
      }); // validate

      if (!this.allowAdd()) {
        return false;
      } // add row


      const $el = acf.duplicate({
        target: this.$clone(args.layout),
        append: this.proxy(function ($el, $el2) {
          // append
          if (args.before) {
            args.before.before($el2);
          } else {
            this.$layoutsWrap().append($el2);
          } // enable


          acf.enable($el2, this.cid); // render

          this.render();
        })
      }); // trigger change for validation errors

      this.$input().trigger('change'); // return

      return $el;
    },
    onClickDuplicate (e, $el) {
      // Validate with warning.
      if (!this.validateAdd()) {
        return false;
      } // get layout and duplicate it.


      const $layout = $el.closest('.layout');
      this.duplicateLayout($layout);
    },
    duplicateLayout ($layout) {
      // Validate without warning.
      if (!this.allowAdd()) {
        return false;
      } // Vars.


      const fieldKey = this.get('key'); // Duplicate layout.

      const $el = acf.duplicate({
        target: $layout,
        // Provide a custom renaming callback to avoid renaming parent row attributes.
        rename (name, value, search, replace) {
          // Rename id attributes from "field_1-search" to "field_1-replace".
          if (name === 'id') {
            return value.replace(`${fieldKey  }-${  search}`, `${fieldKey  }-${  replace}`); // Rename name and for attributes from "[field_1][search]" to "[field_1][replace]".
          } 
            return value.replace(`${fieldKey  }][${  search}`, `${fieldKey  }][${  replace}`);
          
        },
        before ($el) {
          acf.doAction('unmount', $el);
        },
        after ($el, $el2) {
          acf.doAction('remount', $el);
        }
      }); // trigger change for validation errors

      this.$input().trigger('change'); // Update order numbers.

      this.render(); // Draw focus to layout.

      acf.focusAttention($el); // Return new layout.

      return $el;
    },
    validateRemove () {
      // return true if allowed
      if (this.allowRemove()) {
        return true;
      } // vars


      const min = this.get('min');

      let text = acf.__('This field requires at least {min} {label} {identifier}');

      const identifier = acf._n('layout', 'layouts', min); // replace


      text = text.replace('{min}', min);
      text = text.replace('{label}', '');
      text = text.replace('{identifier}', identifier); // add notice

      this.showNotice({
        text,
        type: 'warning'
      }); // return

      return false;
    },
    onClickRemove (e, $el) {
      const $layout = $el.closest('.layout'); // Bypass confirmation when holding down "shift" key.

      if (e.shiftKey) {
        return this.removeLayout($layout);
      } // add class


      $layout.addClass('-hover'); // add tooltip

      const tooltip = acf.newTooltip({
        confirmRemove: true,
        target: $el,
        context: this,
        confirm () {
          this.removeLayout($layout);
        },
        cancel () {
          $layout.removeClass('-hover');
        }
      });
    },
    removeLayout ($layout) {
      // reference
      const self = this; // vars

      const endHeight = this.getValue() == 1 ? 60 : 0; // remove

      acf.remove({
        target: $layout,
        endHeight,
        complete () {
          // trigger change to allow attachment save
          self.$input().trigger('change'); // render

          self.render();
        }
      });
    },
    onClickCollapse (e, $el) {
      // vars
      const $layout = $el.closest('.layout'); // toggle

      if (this.isLayoutClosed($layout)) {
        this.openLayout($layout);
      } else {
        this.closeLayout($layout);
      }
    },
    isLayoutClosed ($layout) {
      return $layout.hasClass('-collapsed');
    },
    openLayout ($layout) {
      $layout.removeClass('-collapsed');
      acf.doAction('show', $layout, 'collapse');
    },
    closeLayout ($layout) {
      $layout.addClass('-collapsed');
      acf.doAction('hide', $layout, 'collapse'); // render
      // - no change could happen if layout was already closed. Only render when closing

      this.renderLayout($layout);
    },
    renderLayout ($layout) {
      // vars
      const $input = $layout.children('input');
      const prefix = $input.attr('name').replace('[acf_fc_layout]', ''); // ajax data

      const ajaxData = {
        action: 'acf/fields/flexible_content/layout_title',
        field_key: this.get('key'),
        i: $layout.index(),
        layout: $layout.data('layout'),
        value: acf.serialize($layout, prefix)
      }; // ajax

      $.ajax({
        url: acf.get('ajaxurl'),
        data: acf.prepareForAjax(ajaxData),
        dataType: 'html',
        type: 'post',
        success (html) {
          if (html) {
            $layout.children('.acf-fc-layout-handle').html(html);
          }
        }
      });
    },
    onUnload () {
      // vars
      let indexes = []; // loop

      this.$layouts().each(function (i) {
        if ($(this).hasClass('-collapsed')) {
          indexes.push(i);
        }
      }); // allow null

      indexes = indexes.length ? indexes : null; // set

      preference.save(this.get('key'), indexes);
    },
    onInvalidField (e, $layout) {
      // open if is collapsed
      if (this.isLayoutClosed($layout)) {
        this.openLayout($layout);
      }
    },
    onHover () {
      // add sortable
      this.addSortable(this); // remove event

      this.off('mouseover');
    }
  });
  acf.registerFieldType(Field);
  /**
   *  Popup
   *
   *  description
   *
   *  @date	7/4/18
   *  @since	5.6.9
   *
   *  @param	type $var Description. Default.
   *  @return	type Description.
   */

  var Popup = acf.models.TooltipConfirm.extend({
    events: {
      'click [data-layout]': 'onConfirm',
      'click [data-event="cancel"]': 'onCancel'
    },
    render () {
      // set HTML
      this.html(this.get('text')); // add class

      this.$el.addClass('acf-fc-popup');
    }
  });
  /**
   *  conditions
   *
   *  description
   *
   *  @date	9/4/18
   *  @since	5.6.9
   *
   *  @param	type $var Description. Default.
   *  @return	type Description.
   */
  // register existing conditions

  acf.registerConditionForFieldType('hasValue', 'flexible_content');
  acf.registerConditionForFieldType('hasNoValue', 'flexible_content');
  acf.registerConditionForFieldType('lessThan', 'flexible_content');
  acf.registerConditionForFieldType('greaterThan', 'flexible_content'); // state

  var preference = new acf.Model({
    name: 'this.collapsedLayouts',
    key (key, context) {
      // vars
      let count = this.get(key + context) || 0; // update

      count++;
      this.set(key + context, count, true); // modify fieldKey

      if (count > 1) {
        key += `-${  count}`;
      } // return


      return key;
    },
    load (key) {
      // vars
      var key = this.key(key, 'load');
      const data = acf.getPreference(this.name); // return

      if (data && data[key]) {
        return data[key];
      } 
        return false;
      
    },
    save (key, value) {
      // vars
      var key = this.key(key, 'save');
      let data = acf.getPreference(this.name) || {}; // delete

      if (value === null) {
        delete data[key]; // append
      } else {
        data[key] = value;
      } // allow null


      if ($.isEmptyObject(data)) {
        data = null;
      } // save


      acf.setPreference(this.name, data);
    }
  });
})(jQuery);

/***/ }),

/***/ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-field-gallery.js":
/*! ********************************************************************************!*\
  !*** ./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-field-gallery.js ***!
  \******************************************************************************* */
/***/ (function() {

(function ($) {
  const Field = acf.Field.extend({
    type: 'gallery',
    events: {
      'click .acf-gallery-add': 'onClickAdd',
      'click .acf-gallery-edit': 'onClickEdit',
      'click .acf-gallery-remove': 'onClickRemove',
      'click .acf-gallery-attachment': 'onClickSelect',
      'click .acf-gallery-close': 'onClickClose',
      'change .acf-gallery-sort': 'onChangeSort',
      'click .acf-gallery-update': 'onUpdate',
      mouseover: 'onHover',
      showField: 'render'
    },
    actions: {
      validation_begin: 'onValidationBegin',
      validation_failure: 'onValidationFailure',
      resize: 'onResize'
    },
    onValidationBegin () {
      acf.disable(this.$sideData(), this.cid);
    },
    onValidationFailure () {
      acf.enable(this.$sideData(), this.cid);
    },
    $control () {
      return this.$('.acf-gallery');
    },
    $collection () {
      return this.$('.acf-gallery-attachments');
    },
    $attachments () {
      return this.$('.acf-gallery-attachment');
    },
    $attachment (id) {
      return this.$(`.acf-gallery-attachment[data-id="${  id  }"]`);
    },
    $active () {
      return this.$('.acf-gallery-attachment.active');
    },
    $main () {
      return this.$('.acf-gallery-main');
    },
    $side () {
      return this.$('.acf-gallery-side');
    },
    $sideData () {
      return this.$('.acf-gallery-side-data');
    },
    isFull () {
      const max = parseInt(this.get('max'));
      const count = this.$attachments().length;
      return max && count >= max;
    },
    getValue () {
      // vars
      const val = []; // loop

      this.$attachments().each(function () {
        val.push($(this).data('id'));
      }); // return

      return val.length ? val : false;
    },
    addUnscopedEvents (self) {
      // invalidField
      this.on('change', '.acf-gallery-side', function (e) {
        self.onUpdate(e, $(this));
      });
    },
    addSortable (self) {
      // add sortable
      this.$collection().sortable({
        items: '.acf-gallery-attachment',
        forceHelperSize: true,
        forcePlaceholderSize: true,
        scroll: true,
        start (event, ui) {
          ui.placeholder.html(ui.item.html());
          ui.placeholder.removeAttr('style');
        },
        update (event, ui) {
          self.$input().trigger('change');
        }
      }); // resizable

      this.$control().resizable({
        handles: 's',
        minHeight: 200,
        stop (event, ui) {
          acf.update_user_setting('gallery_height', ui.size.height);
        }
      });
    },
    initialize () {
      // add unscoped events
      this.addUnscopedEvents(this); // render

      this.render();
    },
    render () {
      // vars
      const $sort = this.$('.acf-gallery-sort');
      const $add = this.$('.acf-gallery-add');
      const count = this.$attachments().length; // disable add

      if (this.isFull()) {
        $add.addClass('disabled');
      } else {
        $add.removeClass('disabled');
      } // disable select


      if (!count) {
        $sort.addClass('disabled');
      } else {
        $sort.removeClass('disabled');
      } // resize


      this.resize();
    },
    resize () {
      // vars
      const width = this.$control().width();
      const target = 150;
      let columns = Math.round(width / target); // max columns = 8

      columns = Math.min(columns, 8); // update data

      this.$control().attr('data-columns', columns);
    },
    onResize () {
      this.resize();
    },
    openSidebar () {
      // add class
      this.$control().addClass('-open'); // hide bulk actions
      // should be done with CSS
      // this.$main().find('.acf-gallery-sort').hide();
      // vars

      let width = this.$control().width() / 3;
      width = parseInt(width);
      width = Math.max(width, 350); // animate

      this.$('.acf-gallery-side-inner').css({
        width: width - 1
      });
      this.$side().animate({
        width: width - 1
      }, 250);
      this.$main().animate({
        right: width
      }, 250);
    },
    closeSidebar () {
      // remove class
      this.$control().removeClass('-open'); // clear selection

      this.$active().removeClass('active'); // disable sidebar

      acf.disable(this.$side()); // animate

      const $sideData = this.$('.acf-gallery-side-data');
      this.$main().animate({
        right: 0
      }, 250);
      this.$side().animate({
        width: 0
      }, 250, function () {
        $sideData.html('');
      });
    },
    onClickAdd (e, $el) {
      // validate
      if (this.isFull()) {
        this.showNotice({
          text: acf.__('Maximum selection reached'),
          type: 'warning'
        });
        return;
      } // new frame


      const frame = acf.newMediaPopup({
        mode: 'select',
        title: acf.__('Add Image to Gallery'),
        field: this.get('key'),
        multiple: 'add',
        library: this.get('library'),
        allowedTypes: this.get('mime_types'),
        selected: this.val(),
        select: $.proxy(function (attachment, i) {
          this.appendAttachment(attachment, i);
        }, this)
      });
    },
    appendAttachment (attachment, i) {
      // vars
      attachment = this.validateAttachment(attachment); // bail early if is full

      if (this.isFull()) {
        return;
      } // bail early if already exists


      if (this.$attachment(attachment.id).length) {
        return;
      } // html


      const html = [`<div class="acf-gallery-attachment" data-id="${  attachment.id  }">`, `<input type="hidden" value="${  attachment.id  }" name="${  this.getInputName()  }[]">`, '<div class="margin" title="">', '<div class="thumbnail">', '<img src="" alt="">', '</div>', '<div class="filename"></div>', '</div>', '<div class="actions">', `<a href="#" class="acf-icon -cancel dark acf-gallery-remove" data-id="${  attachment.id  }"></a>`, '</div>', '</div>'].join('');
      const $html = $(html); // append

      this.$collection().append($html); // move to beginning

      if (this.get('insert') === 'prepend') {
        const $before = this.$attachments().eq(i);

        if ($before.length) {
          $before.before($html);
        }
      } // render attachment


      this.renderAttachment(attachment); // render

      this.render(); // trigger change

      this.$input().trigger('change');
    },
    validateAttachment (attachment) {
      // defaults
      attachment = acf.parseArgs(attachment, {
        id: '',
        url: '',
        alt: '',
        title: '',
        filename: '',
        type: 'image'
      }); // WP attachment

      if (attachment.attributes) {
        attachment = attachment.attributes; // preview size

        const url = acf.isget(attachment, 'sizes', this.get('preview_size'), 'url');

        if (url !== null) {
          attachment.url = url;
        }
      } // return


      return attachment;
    },
    renderAttachment (attachment) {
      // vars
      attachment = this.validateAttachment(attachment); // vars

      const $el = this.$attachment(attachment.id); // Image type.

      if (attachment.type == 'image') {
        // Remove filename.
        $el.find('.filename').remove(); // Other file type.
      } else {
        // Check for attachment featured image.
        const image = acf.isget(attachment, 'image', 'src');

        if (image !== null) {
          attachment.url = image;
        } // Update filename text.


        $el.find('.filename').text(attachment.filename);
      } // Default to mimetype icon.


      if (!attachment.url) {
        attachment.url = acf.get('mimeTypeIcon');
        $el.addClass('-icon');
      } // update els


      $el.find('img').attr({
        src: attachment.url,
        alt: attachment.alt,
        title: attachment.title
      }); // update val

      acf.val($el.find('input'), attachment.id);
    },
    editAttachment (id) {
      // new frame
      const frame = acf.newMediaPopup({
        mode: 'edit',
        title: acf.__('Edit Image'),
        button: acf.__('Update Image'),
        attachment: id,
        field: this.get('key'),
        select: $.proxy(function (attachment, i) {
          this.renderAttachment(attachment); // todo - render sidebar
        }, this)
      });
    },
    onClickEdit (e, $el) {
      const id = $el.data('id');

      if (id) {
        this.editAttachment(id);
      }
    },
    removeAttachment (id) {
      // close sidebar (if open)
      this.closeSidebar(); // remove attachment

      this.$attachment(id).remove(); // render

      this.render(); // trigger change

      this.$input().trigger('change');
    },
    onClickRemove (e, $el) {
      // prevent event from triggering click on attachment
      e.preventDefault();
      e.stopPropagation(); // remove

      const id = $el.data('id');

      if (id) {
        this.removeAttachment(id);
      }
    },
    selectAttachment (id) {
      // vars
      const $el = this.$attachment(id); // bail early if already active

      if ($el.hasClass('active')) {
        return;
      } // step 1


      const step1 = this.proxy(function () {
        // save any changes in sidebar
        this.$side().find(':focus').trigger('blur'); // clear selection

        this.$active().removeClass('active'); // add selection

        $el.addClass('active'); // open sidebar

        this.openSidebar(); // call step 2

        step2();
      }); // step 2

      var step2 = this.proxy(function () {
        // ajax
        const ajaxData = {
          action: 'acf/fields/gallery/get_attachment',
          field_key: this.get('key'),
          id
        }; // abort prev ajax call

        if (this.has('xhr')) {
          this.get('xhr').abort();
        } // loading


        acf.showLoading(this.$sideData()); // get HTML

        const xhr = $.ajax({
          url: acf.get('ajaxurl'),
          data: acf.prepareForAjax(ajaxData),
          type: 'post',
          dataType: 'html',
          cache: false,
          success: step3
        }); // update

        this.set('xhr', xhr);
      }); // step 3

      var step3 = this.proxy(function (html) {
        // bail early if no html
        if (!html) {
          return;
        } // vars


        const $side = this.$sideData(); // render

        $side.html(html); // remove acf form data

        $side.find('.compat-field-acf-form-data').remove(); // merge tables

        $side.find('> table.form-table > tbody').append($side.find('> .compat-attachment-fields > tbody > tr')); // setup fields

        acf.doAction('append', $side);
      }); // run step 1

      step1();
    },
    onClickSelect (e, $el) {
      const id = $el.data('id');

      if (id) {
        this.selectAttachment(id);
      }
    },
    onClickClose (e, $el) {
      this.closeSidebar();
    },
    onChangeSort (e, $el) {
      // Bail early if is disabled.
      if ($el.hasClass('disabled')) {
        return;
      } // Get sort val.


      const val = $el.val();

      if (!val) {
        return;
      } // find ids


      const ids = [];
      this.$attachments().each(function () {
        ids.push($(this).data('id'));
      }); // step 1

      const step1 = this.proxy(function () {
        // vars
        const ajaxData = {
          action: 'acf/fields/gallery/get_sort_order',
          field_key: this.get('key'),
          ids,
          sort: val
        }; // get results

        const xhr = $.ajax({
          url: acf.get('ajaxurl'),
          dataType: 'json',
          type: 'post',
          cache: false,
          data: acf.prepareForAjax(ajaxData),
          success: step2
        });
      }); // step 2

      var step2 = this.proxy(function (json) {
        // validate
        if (!acf.isAjaxSuccess(json)) {
          return;
        } // reverse order


        json.data.reverse(); // loop

        json.data.map(function (id) {
          this.$collection().prepend(this.$attachment(id));
        }, this);
      }); // call step 1

      step1();
    },
    onUpdate (e, $el) {
      // vars
      const $submit = this.$('.acf-gallery-update'); // validate

      if ($submit.hasClass('disabled')) {
        return;
      } // serialize data


      const ajaxData = acf.serialize(this.$sideData()); // loading

      $submit.addClass('disabled');
      $submit.before('<i class="acf-loading"></i> '); // append AJAX action

      ajaxData.action = 'acf/fields/gallery/update_attachment'; // ajax

      $.ajax({
        url: acf.get('ajaxurl'),
        data: acf.prepareForAjax(ajaxData),
        type: 'post',
        dataType: 'json',
        complete () {
          $submit.removeClass('disabled');
          $submit.prev('.acf-loading').remove();
        }
      });
    },
    onHover () {
      // add sortable
      this.addSortable(this); // remove event

      this.off('mouseover');
    }
  });
  acf.registerFieldType(Field); // register existing conditions

  acf.registerConditionForFieldType('hasValue', 'gallery');
  acf.registerConditionForFieldType('hasNoValue', 'gallery');
  acf.registerConditionForFieldType('selectionLessThan', 'gallery');
  acf.registerConditionForFieldType('selectionGreaterThan', 'gallery');
})(jQuery);

/***/ }),

/***/ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-field-repeater.js":
/*! *********************************************************************************!*\
  !*** ./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-field-repeater.js ***!
  \******************************************************************************** */
/***/ (function() {

(function ($) {
  const Field = acf.Field.extend({
    type: 'repeater',
    wait: '',
    events: {
      'click a[data-event="add-row"]': 'onClickAdd',
      'click a[data-event="duplicate-row"]': 'onClickDuplicate',
      'click a[data-event="remove-row"]': 'onClickRemove',
      'click a[data-event="collapse-row"]': 'onClickCollapse',
      showField: 'onShow',
      unloadField: 'onUnload',
      mouseover: 'onHover',
      unloadField: 'onUnload'
    },
    $control () {
      return this.$('.acf-repeater:first');
    },
    $table () {
      return this.$('table:first');
    },
    $tbody () {
      return this.$('tbody:first');
    },
    $rows () {
      return this.$('tbody:first > tr').not('.acf-clone');
    },
    $row (index) {
      return this.$(`tbody:first > tr:eq(${  index  })`);
    },
    $clone () {
      return this.$('tbody:first > tr.acf-clone');
    },
    $actions () {
      return this.$('.acf-actions:last');
    },
    $button () {
      return this.$('.acf-actions:last .button');
    },
    getValue () {
      return this.$rows().length;
    },
    allowRemove () {
      const min = parseInt(this.get('min'));
      return !min || min < this.val();
    },
    allowAdd () {
      const max = parseInt(this.get('max'));
      return !max || max > this.val();
    },
    addSortable (self) {
      // bail early if max 1 row
      if (this.get('max') == 1) {
        return;
      } // add sortable


      this.$tbody().sortable({
        items: '> tr',
        handle: '> td.order',
        forceHelperSize: true,
        forcePlaceholderSize: true,
        scroll: true,
        stop (event, ui) {
          self.render();
        },
        update (event, ui) {
          self.$input().trigger('change');
        }
      });
    },
    addCollapsed () {
      // vars
      const indexes = preference.load(this.get('key')); // bail early if no collapsed

      if (!indexes) {
        return false;
      } // loop


      this.$rows().each(function (i) {
        if (indexes.indexOf(i) > -1) {
          if ($(this).find('.-collapsed-target').length) {
            $(this).addClass('-collapsed');
          }
        }
      });
    },
    addUnscopedEvents (self) {
      // invalidField
      this.on('invalidField', '.acf-row', function (e) {
        const $row = $(this);

        if (self.isCollapsed($row)) {
          self.expand($row);
        }
      });
    },
    initialize () {
      // add unscoped events
      this.addUnscopedEvents(this); // add collapsed

      this.addCollapsed(); // disable clone

      acf.disable(this.$clone(), this.cid); // render

      this.render();
    },
    render () {
      // update order number
      this.$rows().each(function (i) {
        $(this).find('> .order > span').html(i + 1);
      }); // Extract vars.

      const $controll = this.$control();
      const $button = this.$button(); // empty

      if (this.val() == 0) {
        $controll.addClass('-empty');
      } else {
        $controll.removeClass('-empty');
      } // Reached max rows.


      if (!this.allowAdd()) {
        $controll.addClass('-max');
        $button.addClass('disabled');
      } else {
        $controll.removeClass('-max');
        $button.removeClass('disabled');
      } // Reached min rows (not used).
      // if( !this.allowRemove() ) {
      //	$controll.addClass('-min');
      // } else {
      //	$controll.removeClass('-min');
      // }

    },
    validateAdd () {
      // return true if allowed
      if (this.allowAdd()) {
        return true;
      } // vars


      const max = this.get('max');

      let text = acf.__('Maximum rows reached ({max} rows)'); // replace


      text = text.replace('{max}', max); // add notice

      this.showNotice({
        text,
        type: 'warning'
      }); // return

      return false;
    },
    onClickAdd (e, $el) {
      // validate
      if (!this.validateAdd()) {
        return false;
      } // add above row


      if ($el.hasClass('acf-icon')) {
        this.add({
          before: $el.closest('.acf-row')
        }); // default
      } else {
        this.add();
      }
    },
    add (args) {
      // validate
      if (!this.allowAdd()) {
        return false;
      } // defaults


      args = acf.parseArgs(args, {
        before: false
      }); // add row

      const $el = acf.duplicate({
        target: this.$clone(),
        append: this.proxy(function ($el, $el2) {
          // append
          if (args.before) {
            args.before.before($el2);
          } else {
            $el.before($el2);
          } // remove clone class


          $el2.removeClass('acf-clone'); // enable

          acf.enable($el2, this.cid); // render

          this.render();
        })
      }); // trigger change for validation errors

      this.$input().trigger('change'); // return

      return $el;
    },
    onClickDuplicate (e, $el) {
      // Validate with warning.
      if (!this.validateAdd()) {
        return false;
      } // get layout and duplicate it.


      const $row = $el.closest('.acf-row');
      this.duplicateRow($row);
    },
    duplicateRow ($row) {
      // Validate without warning.
      if (!this.allowAdd()) {
        return false;
      } // Vars.


      const fieldKey = this.get('key'); // Duplicate row.

      const $el = acf.duplicate({
        target: $row,
        // Provide a custom renaming callback to avoid renaming parent row attributes.
        rename (name, value, search, replace) {
          // Rename id attributes from "field_1-search" to "field_1-replace".
          if (name === 'id') {
            return value.replace(`${fieldKey  }-${  search}`, `${fieldKey  }-${  replace}`); // Rename name and for attributes from "[field_1][search]" to "[field_1][replace]".
          } 
            return value.replace(`${fieldKey  }][${  search}`, `${fieldKey  }][${  replace}`);
          
        },
        before ($el) {
          acf.doAction('unmount', $el);
        },
        after ($el, $el2) {
          acf.doAction('remount', $el);
        }
      }); // trigger change for validation errors

      this.$input().trigger('change'); // Update order numbers.

      this.render(); // Focus on new row.

      acf.focusAttention($el); // Return new layout.

      return $el;
    },
    validateRemove () {
      // return true if allowed
      if (this.allowRemove()) {
        return true;
      } // vars


      const min = this.get('min');

      let text = acf.__('Minimum rows reached ({min} rows)'); // replace


      text = text.replace('{min}', min); // add notice

      this.showNotice({
        text,
        type: 'warning'
      }); // return

      return false;
    },
    onClickRemove (e, $el) {
      const $row = $el.closest('.acf-row'); // Bypass confirmation when holding down "shift" key.

      if (e.shiftKey) {
        return this.remove($row);
      } // add class


      $row.addClass('-hover'); // add tooltip

      const tooltip = acf.newTooltip({
        confirmRemove: true,
        target: $el,
        context: this,
        confirm () {
          this.remove($row);
        },
        cancel () {
          $row.removeClass('-hover');
        }
      });
    },
    remove ($row) {
      // reference
      const self = this; // remove

      acf.remove({
        target: $row,
        endHeight: 0,
        complete () {
          // trigger change to allow attachment save
          self.$input().trigger('change'); // render

          self.render(); // sync collapsed order
          // self.sync();
        }
      });
    },
    isCollapsed ($row) {
      return $row.hasClass('-collapsed');
    },
    collapse ($row) {
      $row.addClass('-collapsed');
      acf.doAction('hide', $row, 'collapse');
    },
    expand ($row) {
      $row.removeClass('-collapsed');
      acf.doAction('show', $row, 'collapse');
    },
    onClickCollapse (e, $el) {
      // vars
      let $row = $el.closest('.acf-row');
      const isCollpased = this.isCollapsed($row); // shift

      if (e.shiftKey) {
        $row = this.$rows();
      } // toggle


      if (isCollpased) {
        this.expand($row);
      } else {
        this.collapse($row);
      }
    },
    onShow (e, $el, context) {
      // get sub fields
      const fields = acf.getFields({
        is: ':visible',
        parent: this.$el
      }); // trigger action
      // - ignore context, no need to pass through 'conditional_logic'
      // - this is just for fields like google_map to render itself

      acf.doAction('show_fields', fields);
    },
    onUnload () {
      // vars
      let indexes = []; // loop

      this.$rows().each(function (i) {
        if ($(this).hasClass('-collapsed')) {
          indexes.push(i);
        }
      }); // allow null

      indexes = indexes.length ? indexes : null; // set

      preference.save(this.get('key'), indexes);
    },
    onHover () {
      // add sortable
      this.addSortable(this); // remove event

      this.off('mouseover');
    }
  });
  acf.registerFieldType(Field); // register existing conditions

  acf.registerConditionForFieldType('hasValue', 'repeater');
  acf.registerConditionForFieldType('hasNoValue', 'repeater');
  acf.registerConditionForFieldType('lessThan', 'repeater');
  acf.registerConditionForFieldType('greaterThan', 'repeater'); // state

  var preference = new acf.Model({
    name: 'this.collapsedRows',
    key (key, context) {
      // vars
      let count = this.get(key + context) || 0; // update

      count++;
      this.set(key + context, count, true); // modify fieldKey

      if (count > 1) {
        key += `-${  count}`;
      } // return


      return key;
    },
    load (key) {
      // vars
      var key = this.key(key, 'load');
      const data = acf.getPreference(this.name); // return

      if (data && data[key]) {
        return data[key];
      } 
        return false;
      
    },
    save (key, value) {
      // vars
      var key = this.key(key, 'save');
      let data = acf.getPreference(this.name) || {}; // delete

      if (value === null) {
        delete data[key]; // append
      } else {
        data[key] = value;
      } // allow null


      if ($.isEmptyObject(data)) {
        data = null;
      } // save


      acf.setPreference(this.name, data);
    }
  });
})(jQuery);

/***/ })

/** *** */ 	});
/** ********************************************************************* */
/** *** */ 	// The module cache
/** *** */ 	const __webpack_module_cache__ = {};
/** *** */ 	
/** *** */ 	// The require function
/** *** */ 	function __webpack_require__(moduleId) {
/** *** */ 		// Check if module is in cache
/** *** */ 		const cachedModule = __webpack_module_cache__[moduleId];
/** *** */ 		if (cachedModule !== undefined) {
/** *** */ 			return cachedModule.exports;
/** *** */ 		}
/** *** */ 		// Create a new module (and put it into the cache)
/** *** */ 		const module = __webpack_module_cache__[moduleId] = {
/** *** */ 			// no module.id needed
/** *** */ 			// no module.loaded needed
/** *** */ 			exports: {}
/** *** */ 		};
/** *** */ 	
/** *** */ 		// Execute the module function
/** *** */ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/** *** */ 	
/** *** */ 		// Return the exports of the module
/** *** */ 		return module.exports;
/** *** */ 	}
/** *** */ 	
/** ********************************************************************* */
/** *** */ 	/* webpack/runtime/compat get default export */
/** *** */ 	!function() {
/** *** */ 		// getDefaultExport function for compatibility with non-harmony modules
/** *** */ 		__webpack_require__.n = function(module) {
/** *** */ 			const getter = module && module.__esModule ?
/** *** */ 				function() { return module.default; } :
/** *** */ 				function() { return module; };
/** *** */ 			__webpack_require__.d(getter, { a: getter });
/** *** */ 			return getter;
/** *** */ 		};
/** *** */ 	}();
/** *** */ 	
/** *** */ 	/* webpack/runtime/define property getters */
/** *** */ 	!function() {
/** *** */ 		// define getter functions for harmony exports
/** *** */ 		__webpack_require__.d = function(exports, definition) {
/** *** */ 			for(const key in definition) {
/** *** */ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/** *** */ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/** *** */ 				}
/** *** */ 			}
/** *** */ 		};
/** *** */ 	}();
/** *** */ 	
/** *** */ 	/* webpack/runtime/hasOwnProperty shorthand */
/** *** */ 	!function() {
/** *** */ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/** *** */ 	}();
/** *** */ 	
/** *** */ 	/* webpack/runtime/make namespace object */
/** *** */ 	!function() {
/** *** */ 		// define __esModule on exports
/** *** */ 		__webpack_require__.r = function(exports) {
/** *** */ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/** *** */ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/** *** */ 			}
/** *** */ 			Object.defineProperty(exports, '__esModule', { value: true });
/** *** */ 		};
/** *** */ 	}();
/** *** */ 	
/** ********************************************************************* */
const __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {

/*! ***************************************************************************!*\
  !*** ./src/advanced-custom-fields-pro/assets/src/js/pro/acf-pro-input.js ***!
  \************************************************************************** */
__webpack_require__.r(__webpack_exports__);
/* harmony import */ const _acf_field_repeater_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_acf-field-repeater.js */ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-field-repeater.js");
/* harmony import */ const _acf_field_repeater_js__WEBPACK_IMPORTED_MODULE_0___default = /* #__PURE__ */__webpack_require__.n(_acf_field_repeater_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ const _acf_field_flexible_content_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./_acf-field-flexible-content.js */ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-field-flexible-content.js");
/* harmony import */ const _acf_field_flexible_content_js__WEBPACK_IMPORTED_MODULE_1___default = /* #__PURE__ */__webpack_require__.n(_acf_field_flexible_content_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ const _acf_field_gallery_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./_acf-field-gallery.js */ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-field-gallery.js");
/* harmony import */ const _acf_field_gallery_js__WEBPACK_IMPORTED_MODULE_2___default = /* #__PURE__ */__webpack_require__.n(_acf_field_gallery_js__WEBPACK_IMPORTED_MODULE_2__);



}();
/** *** */ })()
;
// # sourceMappingURL=acf-pro-input.js.map