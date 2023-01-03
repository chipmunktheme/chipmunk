<?php

// Initialize Sage view and data providers
// and render the view
echo view(
  app('sage.view'),
  app('sage.data')
)->render();
