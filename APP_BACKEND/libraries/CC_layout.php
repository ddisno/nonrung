<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CC_layout
{
	protected $CI;

	public function __construct(){
        $this->CI =& get_instance();
	}

	    // intregate with getmenu()
    public function _layout_listmenus(){
        $results = $this->CI->model_main->_layout_listmenus();

        $ref   = [];
        $items = [];

        foreach ($results as $data) {
            $thisRef = &$ref[$data->id_menu];

            $thisRef['parent'] = $data->parent;
            $thisRef['label']  = $data->label;
            $thisRef['link']   = $data->link;
            $thisRef['id']     = $data->id_menu;
            $thisRef['icon']   = $data->icon;
            $thisRef['type']   = $data->type;
            $thisRef['target'] = $data->target;

            if ($data->parent == 0) {
                $items[$data->id_menu] = &$thisRef;
            } else {
                $ref[$data->parent]['child'][$data->id_menu] = &$thisRef;
            }
        }

        $html = $this->_layout_get_menu($items);
        return $html;
    }

    public function _layout_get_menu($items, $class = 'sidebar-menu', $widget = 'tree', $class_tree = 'treeview'){

        $html    = "<ul class='" . $class . "' data-widget='" . $widget . "'>";
        $default = '';

        foreach ($items as $key => $value) {

            // active
            $active = '';

            // มากกว่านี้ ให้มาเพิ่มตรงนี้ ทำ sub active ได้แค่ 2 sub ตอนนี้
            if ($this->CI->uri->segment(2) != '') {
                $cut_link = explode('/', $value['link']);
                if (count($cut_link) > 1) {
                    if ($cut_link[0] == $this->CI->uri->segment(1)) {
                        if ($cut_link[1] == $this->CI->uri->segment(2)) {
                            $active = ' active ';
                        } else {
                            $active = '';
                        }
                    } else {
                        $active = '';
                    }
                }
            } else {
                if ($value['link'] == $this->CI->uri->segment(1)) {
                    $active = ' active ';
                } else {
                    $active = '';
                }
            }

            // ถ้า permission หรือ id role = 1 แสดงว่าเป็น ผู้ดูแลระบบ แสดงว่าไม่เข้าเงื่อนไขที่ต้อง เช็ค
            if ($this->CI->session->userdata('id_role') != 1) {
                //เช็คว่ามี id_menu นี้ ใน array หรือไม่ ถ้าไม่มี ให้วนลูปใหม่ ไม่ต้องสร้าง
                if (!in_array($value['id'], $this->CI->model_main->_check_permission_menu())) {
                    continue;
                }

            }


            if($value['type']=='internal'){
                 $link = base_url() . $value['link'];
            }else{
                $link = $value['link'];
            }


            if (array_key_exists('child', $value)) {
                // ตรวจสอบชนิดของลิ้ง
                
                $html .= '<li class="' . $class_tree . '' . $active . '">
                        <a href="' . $link . '" target="'.$value['target'].'">
                          <i class="' . $value['icon'] . '"></i>
                          <span>' . $value['label'] . '</span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>';
                $html .= $this->_layout_get_menu($value['child'], 'treeview-menu', 'treeview');
            } else {
                $html .= '<li class="' . $active . '">
                        <a href="' . $link . '" target="'.$value['target'].'">
                        <i class="' . $value['icon'] . '"></i>
                        <span>' . $value['label'] . '</span>
                      </a>';
            }
            $html .= "</li>";
        }
        $html .= "</ul>";

        return $html;
    }

}

/* End of file Layout.php */
/* Location: .//C/xampp/htdocs/meeting/project/mainpattern/APP_BACKEND/libraries/Layout.php */
