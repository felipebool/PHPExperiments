<?php

   /* This class deals with single file uploads */
   Class File_upload {
      private $name;
      private $type;
      private $size;
      private $tmp_name;
      private $error;

      private $uploaddir;
      private $filename;
      private $uploadfile;

      function __construct($field_name) {
         $this->name     = $_FILES[$field_name]['name'];
         $this->type     = $_FILES[$field_name]['type'];
         $this->size     = $_FILES[$field_name]['size'];
         $this->tmp_name = $_FILES[$field_name]['tmp_name'];
         $this->error    = $_FILES[$field_name]['error'];

         // By default, files will be saved in $uploaddir directory,
         // but this can be changed using set_uploaddir($dir).
         $this->uploaddir  = '/var/www/php/upload/photos/';
         $this->filename   = basename($this->name);
         $this->uploadfile = $this->uploaddir.$this->filename;
      }

      public function get_name() {
         return $this->name;
      }

      public function get_type() {
         return $this->type;
      }

      public function get_size() {
         return $this->size;
      }

      public function get_tmp_name() {
         return $this->tmp_name;
      }

      public function get_error() {
         return $this->error;
      }

      public function get_uploaddir() {
         return $this->uploaddir;
      }

      public function get_filename() {
         return $this->filename;
      }

      public function get_uploadfile() {
         return $this->uploadfile;
      }

      public function set_uploaddir($uploaddir) {
         $this->uploaddir = $uploaddir;
      }

      public function set_filename($filename) {
         $this->filename = $filename;
      }

      public function set_uploadfile($uploadfile) {
         $this->uploadfile = $uploadfile;
      }

      public function test_file() {
         if ($this->size == 0 || $this->error != 0 || file_exists($this->uploadfile))
            return false;
         return true;
      }

      public function save_file() {
         if ($this->test_file() && move_uploaded_file($this->tmp_name, $this->uploadfile))
            return true;
         return false;
      }
   }

