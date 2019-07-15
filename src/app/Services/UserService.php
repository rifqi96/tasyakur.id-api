<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class UserService extends BaseService
{

  public function __construct()
  {
    //
  }

  /**
   * @return Collection
   */
  public function getAll() : Collection
  {
    return User::all();
  }

}