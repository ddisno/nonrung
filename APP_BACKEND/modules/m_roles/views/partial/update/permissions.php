
                <div class="box-body" style="padding: 0">
                  <table class="table" width="100%">
                    <tr>
                      <th></th>
                      <th style="text-align: center;">เปิด / ปิด</th>
                    </tr>
                  <?php
                  foreach ($permissions as $permis) {
                    ?>
                    <tr>
                      <td>
                        <?=$permis->key;?>
                      </td>
                      <td style="text-align: center;">
                        <label>
                          <input type="checkbox" name="old_permis[]" value="<?=$permis->key?>"
                            <?=(in_array($permis->key, $roles_permission)) ? 'checked' : '';?> style="display: none;">
                        </label>

                        <label>
                          <input type="checkbox" name="new_permis[]" class="flat-red" value="<?=$permis->key?>" 
                          <?=(in_array($permis->key, $roles_permission)) ? 'checked' : '';?>>
                        </label>
                          
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                  </table>
                </div>
