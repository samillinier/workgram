<div class="page-title">	
    <h3><?php echo $heading; ?></h3>		
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple ">
            <div class="grid-title">
                <h4>Advance <span class="semi-bold">Options</span></h4>
                <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="reload"></a>  </div>
            </div>
            <div class="grid-body ">
                <table class="table table-hover" id="skill_category_table" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Skill Category Name</th> 
                            <th>Color</th>
                            <th>Added By</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($skill_categories as $skill_category) {
                            ?> 
                            <tr  id="skill_category_<?php echo $skill_category->skill_cat_code; ?>">
                                <td><?php echo ++$i; ?></td>
                                <td><?php echo $skill_category->skill_cat_name; ?></td>
                                <td class="v-align-middle">
                                    <div style="padding:1px;top:9px;right:9px;;font-size:smaller;color:#545454;width: 21px;">
                                        <div style="width:9px;height:0;border:10px solid <?php echo $skill_category->colour; ?>;overflow:hidden"></div>
                                    </div>
                                </td>
                                <td><?php echo $skill_category->employee_fname . ' ' . $skill_category->employee_lname; ?></td>


                                <td>

                                    <a href="<?php echo site_url(); ?>/skill/skill_category_controller/edit_skill_category_view/<?php echo $skill_category->skill_cat_code; ?>">
                                        <span class="label label-info">Edit</span>
                                    </a>
                                    <a style="cursor: pointer;"   title="Delete this skill category" onclick="delete_skill_category(<?php echo $skill_category->skill_cat_code; ?>)">
                                        <span class="label label-important">Delete</span>
                                    </a>

                                </td>
                            </tr>
                        <?php } ?>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_skill_category_modal" tabindex="-1" role="dialog" aria-labelledby="add_skill_category_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add_skill_category_form" name="add_skill_category_form">
                <div class="modal-header tiles green">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-desktop fa-4x"></i>
                    <h4 id="add_skill_category_modalLabel" class="semi-bold text-white">It's a new skill category</h4>
                    <p class="no-margin text-white">Include skill category details here.</p>
                    <br>
                </div>
                <div class="modal-body">


                    <div class="row form-row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">Skill Category Name</label>
                                <span style="color: red">*</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-with-icon  right">                                       
                                <i class=""></i>
                                <input id="skill_cat_name" class="form-control" type="text" name="skill_cat_name">                              
                            </div>
                        </div>
                    </div>

                    <div class="row form-row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">Color</label>
                                <span style="color: red">*</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-with-icon  right">                                       
                                <i class=""></i>
                                <input data-color="rgb(255, 255, 255)" data-color-format="hex" id="colour" class="form-control skill_cat_colour_picker" type="text" name="colour">                              
                            </div>
                        </div>
                    </div>

                </div>
                <div id="add_skill_category_msg" class="form-row"> </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>

    </div>
</div>
<script type="text/javascript">
    $('#skill_parent_menu').addClass('active open');

</script>


