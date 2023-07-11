                      <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modaltugas_akhir"><i class="fa fa-upload"></i> Upload File</button><br><br>
                        <!-- Modal -->
                        <div id="Modaltugas_akhir" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Upload File Spesifikasi Tugas Akhir/Judul Skripsi</h4>
                              </div>
                              <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="student_skpi_file_status" value="tugas_akhir">
                              <input type="hidden" name="action" value="input">

                              <div class="modal-body">
                                 <div class="form-group">
                                     <label class="col-md-3">Judul (Indonesia)</label>
                                     <div class="col-md-9"><textarea name="student_skpi_file_title_ind" class="form-control" placeholder="Judul (Indonesia)" required></textarea></div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-md-3">Judul (Inggris)</label>
                                     <div class="col-md-9"><textarea name="student_skpi_file_title_ing" class="form-control" placeholder="Judul (Inggris)" required></textarea></div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-md-3">Lembaga</label>
                                     <div class="col-md-9"><input type="text" name="student_skpi_file_institution" class="form-control" placeholder="Lembaga" required></div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-md-3">Durasi</label>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <input type="number" name="student_skpi_file_duration" class="form-control" placeholder="Durasi" required>
                                             <span class="input-group-addon" id="basic-addon2">Jam</span>
                                         </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-md-3">Upload File</label>
                                     <div class="col-md-9"><input type="file" name="student_skpi_file" accept=".jpg, .jpeg, .png, .pdf" required>
                                     <p>Format file .pdf, .jpg atau .png.</p></div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                              </div>
                              </form>
                            </div>
                        
                          </div>
                        </div>
                        
                        <table class="table table-bordered">
                        <?php
                        $no=1;
                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='tugas_akhir'");
                        while ($a=mysqli_fetch_array($data)) {
                        ?>
                            <tr>
                                <td width="75%"> <?= $a['student_skpi_file_title_ind']; ?>
                                </td>
                                <td>

                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tugas_akhiredit<?= $no; ?>"><i class="fa fa-edit"></i></button>


                                    <button class="btn btn-danger btn-xs" id="remove" value="<?= $a['student_skpi_file_id']; ?>" onclick="data_remove(this.value);" title="Remove"><i class="fa fa-trash"></i></button>

                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#tugas_akhir<?= $no; ?>"><i class="fa fa-eye"></i></button>
                                
                                    <!-- Modal -->
                                    <div id="tugas_akhiredit<?= $no; ?>" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                    
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">Edit File Spesifikasi Tugas Akhir/Judul Skripsi</h4>
                                          </div>
                                          <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
                                          <input type="hidden" name="student_skpi_file_status" value="tugas_akhir">
                                          <input type="hidden" name="action" value="edit">
                                          <input type="hidden" name="id" value="<?= $a['student_skpi_file_id']; ?>">
                                          <div class="modal-body">
                                             <div class="form-group">
                                                 <label class="col-md-3">Judul (Indonesia)</label>
                                                 <div class="col-md-9"><textarea name="student_skpi_file_title_ind" class="form-control" placeholder="Judul (Indonesia)" required><?= $a['student_skpi_file_title_ind']; ?></textarea></div>
                                             </div>
                                             <div class="form-group">
                                                 <label class="col-md-3">Judul (Inggris)</label>
                                                 <div class="col-md-9"><textarea name="student_skpi_file_title_ing" class="form-control" placeholder="Judul (Inggris)" required><?= $a['student_skpi_file_title_ing']; ?></textarea></div>
                                             </div>
                                             <div class="form-group">
                                                 <label class="col-md-3">Lembaga</label>
                                                 <div class="col-md-9"><input type="text" name="student_skpi_file_institution" value="<?= $a['student_skpi_file_institution']; ?>" class="form-control" placeholder="Lembaga" required></div>
                                             </div>
                                             <div class="form-group">
                                                 <label class="col-md-3">Durasi</label>
                                                 <div class="col-md-9">
                                                     <div class="input-group">
                                                         <input type="number" name="student_skpi_file_duration" value="<?= $a['student_skpi_file_duration']; ?>" class="form-control" placeholder="Durasi" required>
                                                         <span class="input-group-addon" id="basic-addon2">Jam</span>
                                                     </div>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                 <label class="col-md-3">Upload File</label>
                                                 <div class="col-md-9"><input type="file" name="student_skpi_file" accept=".jpg, .jpeg, .png, .pdf">
                                                 <p>*Diisi jika ingin diganti | Format file .pdf, .jpg atau .png.</p></div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                                          </div>
                                          </form>
                                        </div>
                                    
                                      </div>
                                    </div>
                                    
                               
                                <!-- Modal -->
                                    <div id="tugas_akhir<?= $no; ?>" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                    
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">Detail File Spesifikasi Tugas Akhir/Judul Skripsi</h4>
                                          </div>
                                          <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                          <div class="modal-body">
                                             <span>Judul (Indonesia)</span><br>
                                             <b><?= $a['student_skpi_file_title_ind']; ?></b><br>
                                             <span>Judul (Inggris)</span><br>
                                             <b><?= $a['student_skpi_file_title_ing']; ?></b><br>
                                             <span>Lembaga</span><br>
                                             <b><?= $a['student_skpi_file_institution']; ?></b><br>
                                             <span>Durasi</span><br>
                                             <b><?= $a['student_skpi_file_duration']; ?> Jam</b><br>
                                             <span>File</span><br>
                                             <b><a href="download_file.php?act=skpi&file=<?= $account_id; ?>!<?= $a['student_skpi_file']; ?>" target="_blank"> <?= $a['student_skpi_file']; ?> </b>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                          </form>
                                        </div>
                                    
                                      </div>
                                    </div>
                                    </td>
                            </tr>
                        
                        <?php $no++; } ?>
                        </table>