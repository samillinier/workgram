
<div class="row">
    <div class="col-md-12">
        <div class="grid simple vertical green">

            <div class="grid-title no-border">
                <h4>
                    <div class="project-logo">
                        <?php if ($project->project_logo == '') { ?>
                            <img src="<?php echo base_url(); ?>uploads/project_logo/project_default_logo.png"  alt="" data-src="<?php echo base_url(); ?>uploads/project_logo/project_default_logo.png" data-src-retina="<?php echo base_url(); ?>uploads/project_logo/project_default_logo.png" width="69" height="69" />

                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>uploads/project_logo/<?php echo $project->project_logo; ?>"  alt="" data-src="<?php echo base_url(); ?>uploads/project_logo/<?php echo $project->project_logo; ?>" data-src-retina="<?php echo base_url(); ?>uploads/project_logo/<?php echo $project->project_logo; ?>" width="69" height="69" />

                        <?php } ?> 
                    </div>
                    <span class="semi-bold">
                        <?php echo $project->project_vendor; ?>
                    </span>
                </h4>
                <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a>  </div>
                <span class="semi-bold">
                    Deadline 
                </span>
                <span class="label label-important">
                    <?php
                    if ($project->project_end_date == "0000-00-00") {
                        echo 'Not Set';
                    } else {
                        echo date('d M Y', strtotime($project->project_end_date));
                    }
                    ?>
                </span>

            </div>
            <div class="grid-body no-border">
                <div class="row-fluid">
                    <div>
                        <h3><span class="semi-bold"> <?php echo $project->project_name; ?></span></h3>
                        <div class="color-bands green"></div>
                        <div class="color-bands purple"></div>
                        <div class="color-bands red"></div>
                        <div class="color-bands blue"></div>
                        <br>
                        <p><?php echo $project->project_description; ?></p>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<h4>
    Task
    <span class="semi-bold">List</span>
    <div class="pull-right actions">
        <button id="add_task_button" data-toggle="modal" data-target="#add_task_modal" class="btn btn-warning btn-cons" type="button">New Task</button>
    </div>
</h4>
<div class="row">
    <?php
    $employee_task_service = new Employee_task_service();
    $employee_service = new employee_service();

    $project_member_ids = array();
    if (!empty($tasks)) {
        foreach ($tasks as $task) {
            $employees_for_task = $employee_task_service->get_employees_for_task($task->task_id);
            ?>
            <div class="col-md-12">
                <div class="grid simple no-border">
                    <div class="grid-title no-border descriptive clickable">
                        <h4 class="semi-bold"><?php echo ucfirst($task->task_name); ?></h4>
                        <p >
                            Created on <?php echo date('Y-m-d', strtotime($task->added_date)) . ' at ' . date('H:i:s', strtotime($task->added_date)) ?> - Created by <?php echo $task->employee_fname . ' ' . $task->employee_lname; ?>&nbsp;&nbsp;

                            <?php if ($task->task_status == '0') { ?>
                                <span class="label label-important">Pending</span>
                            <?php } else { ?>
                                <span class="label label-success">Complete</span>
                            <?php } ?>

                        </p>
                        <div class="actions"> <a class="view" href="javascript:;"><i class="fa fa-search"></i></a> <a class="remove" href="javascript:;"><i class="fa fa-times"></i></a> </div>
                    </div>

                    <div class="grid-body  no-border" style="display:none">
                        <div class="post">
                            <div class="info-wrapper">
                                <div class="info"> 
                                    <?php echo $task->task_descrption; ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            <p class="text-black semi-bold no-margin">
                                <a href="<?php echo site_url(); ?>/task/task_controller/view_task_detail_view/<?php echo $task->task_id; ?>">
                                    <i class="icon-custom-up "></i>
                                    Detail View
                                </a>
                            </p>
                            <br>
                            <div class="clearfix"></div>
                            <div class="row">

                                <div class="col-md-12">
                                    <h7>
                                        <span class="semi-bold">
                                            Task Members
                                        </span>
                                    </h7>
                                    <div class="clearfix"></div>
                                    <ul class="my-friends no-margin ">
                                        <?php
                                        if (!empty($employees_for_task)) {
                                            ?>
                                            <?php
                                            foreach ($employees_for_task as $employee) {
                                                if (!in_array($employee->employee_code, $project_member_ids)) {
                                                    $project_member_ids[] = $employee->employee_code;
                                                }
                                                ?>
                                                <li>
                                                    <div class="profile-pic">
                                                        <?php if ($employee->employee_avatar == '') {
                                                            ?>
                                                            <img src="<?php echo base_url(); ?>uploads/employee_avatar/avatar_small.jpg"  alt="" data-src="<?php echo base_url(); ?>uploads/employee_avatar/avatar_small.jpg" data-src-retina="<?php echo base_url(); ?>uploads/employee_avatar/avatar_small2x.jpg" width="35" height="35" />
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>uploads/employee_avatar/<?php echo $employee->employee_avatar; ?>"  alt="" data-src="<?php echo base_url(); ?>uploads/employee_avatar/<?php echo $employee->employee_avatar; ?>" data-src-retina="<?php echo base_url(); ?>uploads/employee_avatar/<?php echo $employee->employee_avatar; ?>" width="35" height="35" />
                                                            <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="grid simple no-border">
                                                <div class="row">

                                                    <div class="tiles white col-md-12 no-padding">
                                                        <div class="tiles-body">
                                                            <span>No members assigned yet</span>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>
                </div>
            </div>

            <?php
        }
    } else {
        ?>
        <div class="col-md-12">
            <div class="grid simple no-border">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tiles white col-md-12 no-padding">
                            <div class="tiles-body">
                                <span>No tasks available</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
    }
    ?>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="tiles white col-md-12  no-padding">
            <div class="tiles-body">
                <h5>
                    <span class="semi-bold">
                        Project Administrator
                    </span>
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="friend-list">
                            <div class="friend-profile-pic">
                                <div class="user-profile-pic-normal">
                                    <?php if ($project_admin == '') { ?>

                                        <img src="<?php echo base_url(); ?>uploads/employee_avatar/avatar_small.jpg"  alt="" data-src="<?php echo base_url(); ?>uploads/employee_avatar/avatar_small.jpg" data-src-retina="<?php echo base_url(); ?>uploads/employee_avatar/avatar_small2x.jpg" width="35" height="35" />

                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>uploads/employee_avatar/<?php echo $project_admin->employee_avatar; ?>"  alt="" data-src="<?php echo base_url(); ?>uploads/employee_avatar/<?php echo $project_admin->employee_avatar; ?>" data-src-retina="<?php echo base_url(); ?>uploads/employee_avatar/<?php echo $project_admin->employee_avatar; ?>" width="35" height="35" />

                                    <?php } ?> 
                                </div>
                            </div>
                            <div class="friend-details-wrapper">
                                <div class="friend-name"> <?php echo $project_admin->employee_fname . " " . $project_admin->employee_lname; ?> </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <h5>
                    <span class="semi-bold">
                        Project Members
                    </span>
                </h5>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if (count($project_member_ids) != 0) {
                            ?>
                            <ul class="my-friends no-margin ">
                                <?php
                                foreach ($project_member_ids as $project_member_id) {
                                    $member = $employee_service->get_employee_by_id($project_member_id);
                                    if (!empty($member)) {
                                        ?>

                                        <li>
                                            <div class="profile-pic">
                                                <?php if ($member->employee_avatar == '') {
                                                    ?>
                                                    <img src="<?php echo base_url(); ?>uploads/employee_avatar/avatar_small.jpg"  alt="" data-src="<?php echo base_url(); ?>uploads/employee_avatar/avatar_small.jpg" data-src-retina="<?php echo base_url(); ?>uploads/employee_avatar/avatar_small2x.jpg" width="35" height="35" />
                                                <?php } else { ?>
                                                    <img src="<?php echo base_url(); ?>uploads/employee_avatar/<?php echo $member->employee_avatar; ?>"  alt="" data-src="<?php echo base_url(); ?>uploads/employee_avatar/<?php echo $member->employee_avatar; ?>" data-src-retina="<?php echo base_url(); ?>uploads/employee_avatar/<?php echo $member->employee_avatar; ?>" width="35" height="35" />
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                                ?> 
                            </ul>
                        <?php } else { ?>
                            <div class="grid simple no-border">
                                <div class="row">

                                    <div class="tiles white col-md-12 no-padding">
                                        <div class="tiles-body">
                                            <span>No members assigned yet</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        <?php }
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

<!-- Add New Modal -->
<div class="modal fade" id="add_task_modal" tabindex="-1" role="dialog" aria-labelledby="add_task_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add_task_form" name="add_task_form">
                <div class="modal-header tiles green">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-desktop fa-4x"></i>
                    <h4 id="add_task_modalLabel" class="semi-bold text-white">It's a new task </h4>
                    <p class="no-margin text-white">Include task details here.</p>
                    <br>
                </div>
                <div class="modal-body">
                    <div class="row form-row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">Task</label>
                                <span style="color: red">*</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-with-icon  right">                                       
                                <i class=""></i>
                                <input id="task_name" class="form-control" type="text" name="task_name">                              
                            </div>
                        </div>
                    </div>

                    <div class="row form-row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">Task</label>
                                <span style="color: red">*</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-with-icon  right">                                       
                                <i class=""></i>
                                <input id="task_name" class="form-control" type="text" name="task_name">                              
                            </div>
                        </div>
                    </div>

                    <div class="row form-row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">Deadline</label>
                                <span style="color: red">*</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-with-icon  right input-append primary date  no-padding" id="task_deadline_dpicker">                                       
                                <i class=""></i>

                                <input class="form-control" type="text" id="task_deadline" name="task_deadline" readonly="true" value="<?php echo date("Y-m-d"); ?>">
                                <span class="add-on">
                                    <span class="arrow"></span>
                                    <i class="fa fa-th"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="add_task_msg" class="form-row"> </div>
                <input id="project_id" class="form-control" type="hidden" name="project_id" value="<?php echo $project->project_id; ?>">                              
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>

    </div>
</div>

<script type="text/javascript">
    $('#project_parent_menu').addClass('active open');
</script>