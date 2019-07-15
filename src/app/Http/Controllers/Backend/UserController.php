<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
  /**
   * @var UserService
   */
  private $userService;

  /**
   * Create a new controller instance.
   * @param UserService $userService
   */
  public function __construct(UserService $userService)
  {
      $this->userService = $userService;
  }

  /**
   * @return Response
   */
  public function getAll() : Response
  {
    return response(
      $this->userService->getAll()
    );
  }
}
