<?php
class File {
  private $_fileName,
          $_fileType,
          $_fileExt,
          $_fileTempName,
          $_errors = array(),
          $_fileError = 0,
          $_fileSize,
          $_fullName,
          $_extentions = array('jpg', 'jpeg', 'png'),
          $_max_size = 2000000;


  public function __construct($file) {
    $this->_fileName = $file['name'];
    $this->_fileType = $file['type'];
    $this->_fileTempName = $file['tmp_name'];
    $this->_fileErrors = $file['error'];
    $this->_fileSize = $file['size'];
    $ext = explode('.', $this->_fileName);
    $this->_fileExt = strtolower(end($ext));
  }

  public function upload($name, $destination) {
    if(in_array($this->_fileExt, $this->_extentions)) {
      if($this->_fileError === 0) {
        if($this->_fileSize < $this->_max_size) {
          $fullname = $name . '.' . uniqid("", true) . '.' . $this->_fileExt;
          $this->_fullName = $fullname;
          $fileDestination = $destination . '/' . $fullname;
          move_uploaded_file($this->_fileTempName, $fileDestination);
          return true;
        } else {
          $this->addError('file size cannot exceed' . $this->_max_size . 'KB');
          return false;
        }
      } else {
        $this->addError('file not found');
        return false;
      }
    } else {
      $this->addError('unsupported file type');
      return false;
    }
  }

  private function addError($error) {
    $this->_errors[] = $error;
  }

  public function errors() {
    return $this->_errors;
  }

  public function getName() {
    return $this->_fullName;
  }
}
