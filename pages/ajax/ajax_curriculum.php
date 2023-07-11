<?php
include "../../config/connection.php";
$sy=htmlspecialchars(@$_POST['sy']);
$sm=htmlspecialchars(@$_POST['sm']);
$majors_code=htmlspecialchars(@$_POST['majors']);
?>										


<div class="table-responsive" style="height: 200px; overflow: auto;">
<table class="table table-striped">
					                            <thead>
					                                <tr>
					                                    <th></th>
					                                    <th>Room / Class <?= $sm; ?></th>
					                                    <th>Code | Courses</th>
					                                    <th>Lecturer</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$data=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
					                            		INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					                            		INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					                            		INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					                            		where mc.majors_code='$majors_code' AND 
					                            		mc.curriculum_school_year='$sy' AND
					                            		mc.curriculum_semester='$sm'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><input type="radio" name="curriculum_id" value="<?= $row['curriculum_id']; ?>" required></td>
					                                    <td><?= $row['class_room']; ?> / <?= $row['class']; ?></td>
					                                    <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?></td>
					                                    <td><?= $row['lecturer_name']; ?></td>
					                                </tr>
					                            	<?php } ?>
					                            </tbody>
					                        </table>
					                    </div>