<?php

use App\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('is_admin')) {
  function is_admin() {
    if (Auth::check()) {
      // User is logged in, what's their ID?
      $id = Auth::id();

      if ($id && is_numeric($id) && $id > 0) {
        $user = User::find($id)->firstOrFail();
        
        if ($user && $user['is_admin'] === 1) {
          return true;
        }
      }
    }

    return false;
  }
}