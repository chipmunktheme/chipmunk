
const Merlin = (function($){

    let t;

    // callbacks from form button clicks.
    const callbacks = {
        install_child(btn) {
            const installer = new ChildTheme();
            installer.init(btn);
        },
        activate_license(btn) {
            const license = new ActivateLicense();
            license.init(btn);
        },
        install_plugins(btn){
            const plugins = new PluginManager();
            plugins.init(btn);
        },
        install_content(btn){
            const content = new ContentManager();
            content.init(btn);
        }
    };

    function window_loaded(){

    	const
    	body 		= $('.merlin__body');
    	const body_loading 	= $('.merlin__body--loading');
    	const body_exiting 	= $('.merlin__body--exiting');
    	const drawer_trigger 	= $('#merlin__drawer-trigger');
    	const drawer_opening 	= 'merlin__drawer--opening';
    	drawer_opened 	= 'merlin__drawer--open';

    	setTimeout(function(){
	        body.addClass('loaded');
	    },100);

    	drawer_trigger.on('click', function(){
        	body.toggleClass( drawer_opened );
        });

    	$('.merlin__button--proceed:not(.merlin__button--closer)').click(function (e) {
		    e.preventDefault();
		    const goTo = this.getAttribute("href");

		    body.addClass('exiting');

		    setTimeout(function(){
		        window.location = goTo;
		    },400);
		});

        $(".merlin__button--closer").on('click', function(e){

        	body.removeClass( drawer_opened );

            e.preventDefault();
		    const goTo = this.getAttribute("href");

		    setTimeout(function(){
		        body.addClass('exiting');
		    },600);

		    setTimeout(function(){
		        window.location = goTo;
		    },1100);
        });

        $(".button-next").on( "click", function(e) {
            e.preventDefault();
            const loading_button = merlin_loading_button(this);
            if ( ! loading_button ) {
                return false;
            }
            const data_callback = $(this).data("callback");
            if( data_callback && typeof callbacks[data_callback] !== "undefined"){
                // We have to process a callback before continue with form submission.
                callbacks[data_callback](this);
                return false;
            } 
                return true;
            
        });

				$( document ).on( 'change', '.js-merlin-demo-import-select', function() {
					const selectedIndex  = $( this ).val();

					$( '.js-merlin-select-spinner' ).show();

					$.post( merlin_params.ajaxurl, {
						action: 'merlin_update_selected_import_data_info',
						wpnonce: merlin_params.wpnonce,
						selected_index: selectedIndex,
					}, function( response ) {
						if ( response.success ) {
							$( '.js-merlin-drawer-import-content' ).html( response.data );
						}
						else {
							alert( merlin_params.texts.something_went_wrong );
						}

						$( '.js-merlin-select-spinner' ).hide();
					} )
						.fail( function() {
							$( '.js-merlin-select-spinner' ).hide();
							alert( merlin_params.texts.something_went_wrong )
						} );
				} );
    }

    function ChildTheme() {
    	const body 				= $('.merlin__body');
        let complete; const notice 	= $("#child-theme-text");

        function ajax_callback(r) {

            if (typeof r.done !== "undefined") {
            	setTimeout(function(){
			        notice.addClass("lead");
			    },0);
			    setTimeout(function(){
			        notice.addClass("success");
			        notice.html(r.message);
			    },600);


                complete();
            } else {
                notice.addClass("lead error");
                notice.html(r.error);
            }
        }

        function do_ajax() {
            jQuery.post(merlin_params.ajaxurl, {
                action: "merlin_child_theme",
                wpnonce: merlin_params.wpnonce,
            }, ajax_callback).fail(ajax_callback);
        }

        return {
            init(btn) {
                complete = function() {

                	setTimeout(function(){
				$(".merlin__body").addClass('js--finished');
			},1500);

                	body.removeClass( drawer_opened );

                	setTimeout(function(){
				$('.merlin__body').addClass('exiting');
			},3500);

                    	setTimeout(function(){
				window.location.href=btn.href;
			},4000);

                };
                do_ajax();
            }
        }
    }










function ActivateLicense() {
    	const body 		= $( '.merlin__body' );
    	const wrapper 		= $( '.merlin__content--license-key' );
        let complete; const notice 	= $( '#license-text' );

        function ajax_callback(r) {

            if (typeof r.success !== "undefined" && r.success) {
              notice.siblings( '.error-message' ).remove();
            	setTimeout(function(){
			        notice.addClass("lead");
			    },0);
			    setTimeout(function(){
			        notice.addClass("success");
			        notice.html(r.message);
			    },600);
                complete();
            } else {
                $( '.js-merlin-license-activate-button' ).removeClass( 'merlin__button--loading' ).data( 'done-loading', 'no' );
                notice.siblings( '.error-message' ).remove();
                wrapper.addClass('has-error');
                notice.html(r.message);
                notice.siblings( '.error-message' ).addClass("lead error");
            }
        }


        function do_ajax() {

        	wrapper.removeClass('has-error');

            jQuery.post(merlin_params.ajaxurl, {
              action: "merlin_activate_license",
              wpnonce: merlin_params.wpnonce,
              license_key: $( '.js-license-key' ).val()
            }, ajax_callback).fail(ajax_callback);


        }

        return {
            init(btn) {
                complete = function() {
                	setTimeout(function(){
				$(".merlin__body").addClass('js--finished');
			},1500);

                	body.removeClass( drawer_opened );

                	setTimeout(function(){
				$('.merlin__body').addClass('exiting');
			},3500);

                    	setTimeout(function(){
				window.location.href=btn.href;
			},4000);

                };
                do_ajax();
            }
        }
    }

function PluginManager(){

    	const body = $('.merlin__body');
        let complete;
        let items_completed 	= 0;
        let current_item 		= "";
        let $current_node;
        let current_item_hash 	= "";

        function ajax_callback(response){
            const currentSpan = $current_node.find("label");
            if(typeof response === "object" && typeof response.message !== "undefined"){
                currentSpan.removeClass( 'installing success error' ).addClass(response.message.toLowerCase());

                // The plugin is done (installed, updated and activated).
                if(typeof response.done !== "undefined" && response.done){
                    find_next();
                }else if(typeof response.url !== "undefined"){
                    // we have an ajax url action to perform.
                    if(response.hash == current_item_hash){
                        currentSpan.removeClass( 'installing success' ).addClass("error");
                        find_next();
                    }else {
                        current_item_hash = response.hash;
                        jQuery.post(response.url, response, ajax_callback).fail(ajax_callback);
                    }
                }else{
                    // error processing this plugin
                    find_next();
                }
            }else{
                // The TGMPA returns a whole page as response, so check, if this plugin is done.
                process_current();
            }
        }

        function process_current(){
            if(current_item){
                const $check = $current_node.find("input:checkbox");
                if($check.is(":checked")) {
                    jQuery.post(merlin_params.ajaxurl, {
                        action: "merlin_plugins",
                        wpnonce: merlin_params.wpnonce,
                        slug: current_item,
                    }, ajax_callback).fail(ajax_callback);
                }else{
                    $current_node.addClass("skipping");
                    setTimeout(find_next,300);
                }
            }
        }

        function find_next(){
            if($current_node){
                if(!$current_node.data("done_item")){
                    items_completed++;
                    $current_node.data("done_item",1);
                }
                $current_node.find(".spinner").css("visibility","hidden");
            }
            const $li = $(".merlin__drawer--install-plugins li");
            $li.each(function(){
                const $item = $(this);

                if ( $item.data("done_item") ) {
                    return true;
                }

                current_item = $item.data("slug");
                $current_node = $item;
                process_current();
                return false;
            });
            if(items_completed >= $li.length){
                // finished all plugins!
                complete();
            }
        }

        return {
            init(btn){
                $(".merlin__drawer--install-plugins").addClass("installing");
                $(".merlin__drawer--install-plugins").find("input").prop("disabled", true);
                complete = function(){

                	setTimeout(function(){
				        $(".merlin__body").addClass('js--finished');
				    },1000);

                	body.removeClass( drawer_opened );

                	setTimeout(function(){
				        $('.merlin__body').addClass('exiting');
				    },3000);

                    setTimeout(function(){
				        window.location.href=btn.href;
				    },3500);

                };
                find_next();
            }
        }
    }
    function ContentManager(){

    	const body 				= $('.merlin__body');
        let complete;
        let items_completed 	= 0;
        let current_item 		= "";
        let $current_node;
        let current_item_hash 	= "";
        let current_content_import_items = 1;
        let total_content_import_items = 0;
        let progress_bar_interval;

        function ajax_callback(response) {
            const currentSpan = $current_node.find("label");
            if(typeof response === "object" && typeof response.message !== "undefined"){
                currentSpan.addClass(response.message.toLowerCase());

                if( typeof response.num_of_imported_posts !== "undefined" && total_content_import_items > 0 ) {
                    current_content_import_items = response.num_of_imported_posts === 'all' ? total_content_import_items : response.num_of_imported_posts;
                    update_progress_bar();
                }

                if(typeof response.url !== "undefined"){
                    // we have an ajax url action to perform.
                    if(response.hash === current_item_hash){
                        currentSpan.addClass("status--failed");
                        find_next();
                    }else {
                        current_item_hash = response.hash;

                        // Fix the undefined selected_index issue on new AJAX calls.
                        if ( typeof response.selected_index === "undefined" ) {
                            response.selected_index = $( '.js-merlin-demo-import-select' ).val() || 0;
                        }

                        jQuery.post(response.url, response, ajax_callback).fail(ajax_callback); // recuurrssionnnnn
                    }
                }else if(typeof response.done !== "undefined"){
                    // finished processing this plugin, move onto next
                    find_next();
                }else{
                    // error processing this plugin
                    find_next();
                }
            }else{
                console.log(response);
                // error - try again with next plugin
                currentSpan.addClass("status--error");
                find_next();
            }
        }

        function process_current(){
            if(current_item){
                const $check = $current_node.find("input:checkbox");
                if($check.is(":checked")) {
                    jQuery.post(merlin_params.ajaxurl, {
                        action: "merlin_content",
                        wpnonce: merlin_params.wpnonce,
                        content: current_item,
                        selected_index: $( '.js-merlin-demo-import-select' ).val() || 0
                    }, ajax_callback).fail(ajax_callback);
                }else{
                    $current_node.addClass("skipping");
                    setTimeout(find_next,300);
                }
            }
        }

        function find_next(){
            let do_next = false;
            if($current_node){
                if(!$current_node.data("done_item")){
                    items_completed++;
                    $current_node.data("done_item",1);
                }
                $current_node.find(".spinner").css("visibility","hidden");
            }
            const $items = $(".merlin__drawer--import-content__list-item");
            const $enabled_items = $(".merlin__drawer--import-content__list-item input:checked");
            $items.each(function(){
                if (current_item == "" || do_next) {
                    current_item = $(this).data("content");
                    $current_node = $(this);
                    process_current();
                    do_next = false;
                } else if ($(this).data("content") == current_item) {
                    do_next = true;
                }
            });
            if(items_completed >= $items.length){
                complete();
            }
        }

        function init_content_import_progress_bar() {
            if( ! $(".merlin__drawer--import-content__list-item .checkbox-content").is( ':checked' ) ) {
                return false;
            }

            jQuery.post(merlin_params.ajaxurl, {
                action: "merlin_get_total_content_import_items",
                wpnonce: merlin_params.wpnonce,
                selected_index: $( '.js-merlin-demo-import-select' ).val() || 0
            }, function( response ) {
                total_content_import_items = response.data;

                if ( total_content_import_items > 0 ) {
                    update_progress_bar();

                    // Change the value of the progress bar constantly for a small amount (0,2% per sec), to improve UX.
                    progress_bar_interval = setInterval( function() {
                        current_content_import_items += total_content_import_items/500;
                        update_progress_bar();
                    }, 1000 );
                }
            } );
        }

        function valBetween(v, min, max) {
            return (Math.min(max, Math.max(min, v)));
        }

        function update_progress_bar() {
            $('.js-merlin-progress-bar').css( 'width', `${(current_content_import_items/total_content_import_items) * 100  }%` );

            const $percentage = valBetween( ((current_content_import_items/total_content_import_items) * 100) , 0, 99);

            $('.js-merlin-progress-bar-percentage').html( `${Math.round( $percentage )  }%` );

            if ( current_content_import_items/total_content_import_items === 1 ) {
                clearInterval( progress_bar_interval );
            }
        }

        return {
            init(btn){
                $(".merlin__drawer--import-content").addClass("installing");
                $(".merlin__drawer--import-content").find("input").prop("disabled", true);
                complete = function(){

			$.post(merlin_params.ajaxurl, {
				action: "merlin_import_finished",
				wpnonce: merlin_params.wpnonce,
				selected_index: $( '.js-merlin-demo-import-select' ).val() || 0
			});

			setTimeout(function(){
				$('.js-merlin-progress-bar-percentage').html( '100%' );
			},100);

                	setTimeout(function(){
				       body.removeClass( drawer_opened );
				    },500);

                	setTimeout(function(){
				        $(".merlin__body").addClass('js--finished');
				    },1500);

                	setTimeout(function(){
				        $('.merlin__body').addClass('exiting');
				    },3400);

                    setTimeout(function(){
				        window.location.href=btn.href;
				    },4000);
                };
                init_content_import_progress_bar();
                find_next();
            }
        }
    }

    function merlin_loading_button( btn ){

        const $button = jQuery(btn);

        if ( $button.data( "done-loading" ) == "yes" ) {
        	return false;
        }

        let completed = false;

        const _modifier = $button.is("input") || $button.is("button") ? "val" : "text";

        $button.data("done-loading","yes");

        $button.addClass("merlin__button--loading");

        return {
            done(){
                completed = true;
                $button.attr("disabled",false);
            }
        }

    }

    return {
        init(){
            t = this;
            $(window_loaded);
        },
        callback(func){
            console.log(func);
            console.log(this);
        }
    }

})(jQuery);

Merlin.init();
