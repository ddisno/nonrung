<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab" ><i class="fa fa-wrench"></i></a></li>     
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      <li><a href="#control-sidebar-layout-tab" data-toggle="tab"><i class="fa fa-paint-brush"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab" >
        <h3 class="control-sidebar-heading">ตั้งค่าระบบทั่วไป</h3>
         <ul class="control-sidebar-menu">
          <li>

            <a href="<?=base_url()?>m_roles">
              <i class="menu-icon fa fa-gear bg-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">ตั้งค่าทั่วไป <br>ระบบจัดการหลังบ้าน</h4>

                <p>General webback setting</p>
              </div>
            </a>

          </li>
        </ul>
        <h3 class="control-sidebar-heading">ตั้งค่าระบบขั้นสูง</h3>
        <ul class="control-sidebar-menu">
          <li>

            <a href="<?=base_url()?>m_roles">
              <i class="menu-icon fa fa-user-secret bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">จัดการบทบาท</h4>

                <p>Roles management</p>
              </div>
            </a>

            <a href="<?=base_url()?>m_members">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">จัดการผู้ใช้งาน</h4>

                <p>Members management</p>
              </div>
            </a>

            <a href="<?=base_url()?>m_menus">
              <i class="menu-icon fa fa-gears bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">จัดการเมนู</h4>

                <p>Menus management</p>
              </div>
            </a>

            <a href="<?=base_url()?>m_permissions">
              <i class="menu-icon fa fa-key bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">จัดการสิทธิ์การใช้งาน</h4>

                <p>Permission management</p>
              </div>
            </a>

            

          </li>
        </ul>
        
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">ตั้งค่าทั่วไป</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              ปิดเว็บไซต์
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
             ปิด หรือ หยุดให้บริการชั่วคราว สำหรับนักพัฒนา
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-layout-tab">

      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->