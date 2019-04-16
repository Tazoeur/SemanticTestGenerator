<?php


class TestGenerator
{
    private $base;
    private $changes;
    private $output_dir;
    private $begin_file_name;
    private $count_instead_of_name;
    private $extension;

    public function __construct(string $base, array $changes, string $begin_file_name, string $output_dir, array $count_instead_of_name = [])
    {
        $this->base = $base;
        $this->changes = $this->get_combinaisons($changes);
        $this->output_dir = $output_dir;
        $this->begin_file_name = $begin_file_name;
        $this->count_instead_of_name = $count_instead_of_name;
        $this->extension = '.playplus';
    }

    private function get_combinaisons(array $changes) {
        if(empty($changes)) {
            return [];
        }

        $search = array_keys($changes)[0];
        $items = $changes[$search];
        unset($changes[$search]);

        $tab = [];
        foreach($items as $replace) {
            $o = new stdClass();
            $o->search = $search;
            $o->replace = $replace;
            $o->next = $this->get_combinaisons($changes);
            $tab[] = $o;
        }
        return $tab;
    }

    public function generate() {

        $array = $this->changes;

        foreach($array as $object) {
            $this->replace_base_with_object($object);
        }
    }

    private function replace_base_with_object($object, $file_name = null, $file_content = null, $count = 0) {
        if($file_name === null) {
            $file_name = $this->begin_file_name;
        }

        if($file_content === null) {
            $file_content = $this->base;
        }

        if(!in_array($object->search, $this->count_instead_of_name)) {
            $file_name .=  '_' . $object->replace;
            $count = 0;
        } else {
            $file_name .= '_' . $count;
        }

        $file_content = str_replace($object->search, $object->replace, $file_content);

        if(count($object->next) > 0) {
            foreach($object->next as $child) {
                $count++;
                $this->replace_base_with_object($child, $file_name, $file_content, $count);
            }
        } else {
            file_put_contents($this->output_dir . '/' . $file_name . $this->extension, $file_content);
        }
    }

}