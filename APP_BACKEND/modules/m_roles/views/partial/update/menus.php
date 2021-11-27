
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
                          <input type="checkbox" name="old_menus[]" value="<?=$menu->id_menu?>"
                            <?=(in_array($menu->id_menu, $roles_menu)) ? 'checked' : '';?> style="display: none;">
                          </label>

                        <label>
                          <input type="checkbox" name="new_menus[]" class="flat-red" value="<?=$menu->id_menu?>" 
                          <?=(in_array($menu->id_menu, $roles_menu)) ? 'checked' : '';?>>
                        </label>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                  </table>
                </div>
