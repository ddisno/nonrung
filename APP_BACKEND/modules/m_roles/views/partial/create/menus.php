
                <div class="box-body" style="padding: 0">
                  <table class="table" width="100%">
                    <tr>
                      <th></th>
                      <th style="text-align: center;">เปิด / ปิด</th>
                    </tr>
                  <?php
                  foreach ($menus as $menu) {
                    ?>
                    <tr>
                      <td>
                        <?=$menu->label;?>
                      </td>
                      <td style="text-align: center;">
                        
                        <label>
                          <input type="checkbox" name="id_menu[]" class="flat-red" value="<?=$menu->id_menu?>" 
                          <?=set_checkbox('id_menu[]',$menu->id_menu)?>>
                        </label>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                  </table>
                </div>
