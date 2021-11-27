
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
                        
                        <key>
                          <input type="checkbox" name="id_permis[]" class="flat-red" value="<?=$permis->key?>" 
                          <?=set_checkbox('id_permis[]',$permis->key)?>>
                        </key>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                  </table>
                </div>
