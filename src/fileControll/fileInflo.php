<?php
class FileInfoTool
{

  /**
   * @var str => $file = caminho para o arquivo (ABSOLUTO OU RELATIVO)
   * @var arr => $file_info = array contendo as informações obtidas do arquivo informado
   */
  private $file;
  private $file_info;

  /**
   * @param str => $file = caminho para o arquivo (ABSOLUTO OU RELATIVO)
   */
  public function get_file(string $file)
  {
    clearstatcache();
    $file = str_replace(array('/', '\\'), array(DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR), $file);
    if (!is_file($file) && !is_executable($file) && !is_readable($file)) {
      throw new \Exception('O arquivo informado não foi encontrado!');
    }
    $this->file = $file;
    $this->set_file_info($this->file);
    return $this;
  }

  /**
   * @param str => $index = se for informado um indice é retornada uma informação específica do arquivo
   */
  public function get_info($index = '')
  {
    if ($this->get_file_is_called()) {
      if ($index === '') {
        return $this->file_info;
      }
      if ($index != '') {
        if (!array_key_exists($index, $this->file_info)) {
          throw new \Exception('A informação requisitada não foi encontrada!');
        }
        return $this->file_info;
      }
    }
  }

  /**
   * @todo verifica se o método get_file() foi utilizado para informar o caminho do arquivo
   */
  private function get_file_is_called()
  {
    if (!$this->file) {
      throw new \Exception('Nenhum arquivo foi fornecido para análise. Utilize o método get_file() para isso!');
      return false;
    }
    return true;
  }

  /**
   * @todo preencher a array com as infos do arquivo
   */
  private function set_file_info()
  {
    $this->file_info = array();
    $pathinfo = pathinfo($this->file);
    $stat = stat($this->file);
    $this->file_info['realpath'] = realpath($this->file);
    $this->file_info['dirname'] = $pathinfo['dirname'];
    $this->file_info['basename'] = $pathinfo['basename'];
    $this->file_info['filename'] = $pathinfo['filename'];
    $this->file_info['extension'] = $pathinfo['extension'];
    $this->file_info['mime'] = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $this->file);
    $this->file_info['encoding'] = finfo_file(finfo_open(FILEINFO_MIME_ENCODING), $this->file);
    $this->file_info['size'] = $stat[7];
    $this->file_info['size_string'] = $this->format_bytes($stat[7]);
    $this->file_info['atime'] = $stat[8];
    $this->file_info['mtime'] = $stat[9];
    $this->file_info['permission'] = substr(sprintf('%o', fileperms($this->file)), -4);
    $this->file_info['fileowner'] = getenv('USERNAME');
  }

  /**
   * @param int => $size = valor em bytes a ser formatado
   */
  private function format_bytes(int $size)
  {
    $base = log($size, 1024);
    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
    return round(pow(1024, $base - floor($base)), 2) . '' . $suffixes[floor($base)];
  }
}

var_dump((new FileInfoTool)->get_file('sitemap.xml')->get_info());
