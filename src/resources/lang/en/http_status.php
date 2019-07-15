<?php

return [
  
  // 2xx
  '200' => 'OK!',
  '201' => 'Created! The resource has been created',
  '204' => '',
  
  // 4xx
  '400' => 'Whoops, bad request! Please check your request again.',
  '404' => [
    'ModelNotFoundException' => 'Resource is not found',
    'NotFoundHttpException' => 'Route is not found'
  ],
  '405' => 'Method is not allowed',
  '401' => 'Sorry, you are not authenticated',
  '403' => 'Sorry, you are not authorized to perform the action',
  '422' => 'Validation Error',
  
  // 5xx
  '500' => 'Whoops, something went wrong with our server',
  
];