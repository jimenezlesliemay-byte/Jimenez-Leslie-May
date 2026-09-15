<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model {
    protected $table = 'user_form';
    protected $primary_key = 'id';
    protected $fillable = ['username', 'password', 'confirm_password'];
    protected $guarded = ['id'];

    public function __construct()
    {
        parent::__construct();
    }
}