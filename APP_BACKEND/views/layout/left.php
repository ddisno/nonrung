<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" >
        <div class="pull-left image" >
          <img src="<?=$this->config->item('vendor')?>img/keyadmin.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('f_name').' '.$this->session->userdata('l_name')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> 
          
          <?php

                if($this->session->userdata('id_role')==1){
                  echo '<span class="text-red">ผู้ดูแลระบบ</span>';
                }else{
                  echo '<span class="text-green">'.$_get_role.'</span>';
                }
                
           
          ?>
        </a>
        </div>
      </div>

      <script type="text/javascript">
        $(function(){
          if($('.sidebar-menu li').hasClass('active')){
            return false;
          }else{
            $('#first-menu').addClass('active');
          }
        })
      </script>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?=$_get_menus?>
    </section>
    <!-- /.sidebar -->
  </aside>
  
  