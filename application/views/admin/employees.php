<script type="text/javascript">
function edit(id = null)
{   

    $('#edit')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    if(id == null)
    {
         $('#editform').modal('show'); // show bootstrap modal
         $('.modal-title').text('Add employee'); // Set Title to Bootstrap modal title
    }
    else
    {
        $.ajax({
                url : "<?php echo site_url('admin/employee_edit/')?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    $('[name="id"]').val(data.empnum);
                    $('[name="surname"]').val(data.surname);
                    $('[name="name"]').val(data.name);
                    $('[name="address"]').val(data.address);
                    $('[name="phone"]').val(data.phone);
                    $('[name="salary"]').val(data.salary);
                    $('[name="ratingid"]').val(data.ratingid);
                    $('[name="type"]').val(data.type);
                    $('[name="age"]').val(data.age);
                    $('[name="working_hour"]').val(data.working_hour);
                    $('#editform').modal('show'); // show bootstrap modal
                    $('.modal-title').text('Edit employee'); // Set Title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
    }
     
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
        url = "<?php echo site_url('admin/employee_update')?>";
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#edit').serialize(),
        dataType: "JSON",
        success: function(data)
        {           
            if(data.status) //if success close modal and reload ajax table
            {
                $('#editform').modal('hide');
                setTimeout(function(){// wait for 5 secs(2)
                                       window.location.reload(); // then reload the page.(3)
                                  }, 500); 
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}
</script>
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">List of Employees <button type="button" class="btn btn-primary btn-xs" data-original-title="Edit User" onclick="edit()">
                                    Add an Employee</i>
                                </button> <a href="<?=site_url('admin/pilot_working_hourse')?>"  class="btn btn-success btn-xs">
                                    Pilot Working Hours</i>
                                </a></h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>S/NO</th>
                            <th>Surname</th>
                            <th>Othernames</th>
                            <th>Address</th>
                            <th>Salary</th>
                            <th>Phone Number</th>
                            <th>Age</th>
                            <th>Position</th>
                            <th>Working Hour</th>
                            <th>Rating</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result != '') { $i=0; foreach($result as $r){ 
                            ?>
                            <tr>
                                <td><?=$i+=1;?></td>
                                <td><?=$r->surname;?></td>
                                <td><?=$r->name;?></td>
                                <td><?=$r->address;?></td>
                                <td><?=$r->salary;?></td>
                                <td><?=$r->phone;?></td>
                                <td><?=$r->age;?></td>
                                <td><?=$r->type;?></td>
                                <td><?=$r->working_hour;?></td>
                                <td><?=dbInfo('rating_m','ratno',$r->ratingid,'name');?></td>
                                <td>
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs" data-original-title="Edit User" onclick="edit(<?=$r->empnum;?>)">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </div>
                                </td>
                            </tr>

                        <?php } } ?>

                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade" id="editform" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Edit</span> 
                    <span class="fw-light">
                        Details
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Edit the details of the employee using this form, make sure you fill them all</p>
                <form action="#" id="edit">
                    <input type="hidden"  name="id"/>
                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Surname</label>
                                <input id="addName" name="surname" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Othername</label>
                                <input id="addName" name="name" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>address</label>
                                <input id="addName" name="address" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Phone Number</label>
                                <input id="addName" name="phone" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>salary</label>
                                <input id="addName" name="salary" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Type (Flight attendant, Co-pilot, Pilot)</label>
                                <input id="addName" name="type" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Age</label>
                                <input id="addName" name="age" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Working Hour</label>
                                <input id="addName" name="working_hour" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Rating</label>
                                <select name="ratingid" class="form-control">
                                <option value="">--SELECT--</option>
                                <?php foreach ($rating as $key) { ?>
                                <option value="<?=$key->ratno;?>"><?=$key->name;?></option>
                               <?php  } ?>
                            </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>