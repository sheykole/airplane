<script type="text/javascript">
 
function edit(id = null)
{   
    $('[name="id"]').val('');
    $('[name="name_user"]').val('');
    $('[name="username_user"]').val('');
    $('[name="email"]').val('');
    $('[name="pno"]').val('');
    $('[name="status"]').val('');
    $('#edit')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    if(id == null)
    {
         $('#editform').modal('show'); // show bootstrap modal
         $('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
    }
    else
    {
        $.ajax({
                url : "<?php echo site_url('admin/user_edit/')?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                   
                    $('[name="id"]').val(data.id);
                    $('[name="name_user"]').val(data.name);
                    $('[name="username_user"]').val(data.username);
                    $('[name="email"]').val(data.email);
                    $('[name="pno"]').val(data.phone);
                    $('[name="status"]').val(data.status);
                    $('#editform').modal('show'); // show bootstrap modal
                    $('.modal-title').text('Edit User'); // Set Title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
    }
     
}

function password(id)
{    
    $('#editPassForm')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('[name="idPass"]').val(id);
    $('#editPass').modal('show'); // show bootstrap modal
    $('.modal-title').text('Change Password'); // Set Title to Bootstrap modal title
  
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
        url = "<?php echo site_url('admin/user_update')?>";
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
function savePass()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
        url = "<?php echo site_url('admin/user_password')?>";
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#editPassForm').serialize(),
        dataType: "JSON",
        success: function(data)
        {           
            if(data.status) //if success close modal and reload ajax table
            {
                $('#editPass').modal('hide');
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

                <h4 class="mt-0 header-title">List of Administrators <button type="button" class="btn btn-primary btn-xs" data-original-title="Edit User" onclick="edit()">
                                    Add User</i>
                                </button></h4>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>S/NO</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Joined Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach($admin as $r){ ?>
                            <tr>
                                <td><?=$i+=1;?></td>
                                <td><?=$r->username;?></td>
                                <td><?=$r->name;?></td>
                                <td><?=$r->phone;?></td>
                                <td><?=$r->email?></td>
                                <td><?=BtnStatus($r->status);?></td>
                                <td><?=date('d-m-Y H:i:s',strtotime($r->join_date));?></td>
                                <td>
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs" data-original-title="Edit User" onclick="edit(<?=$r->id;?>)">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-warning btn-xs" data-original-title="Change Password" onclick="password(<?=$r->id;?>)">
                                    <i class="fa fa-lock"></i>
                                </button>
                            </div>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
                </div>
                
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
                <p class="small">Edit the details of the user using this form, make sure you fill them all</p>
                <form action="#" id="edit">
                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <input type="hidden"  name="id"/>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Name</label>
                                <input id="addName" name="name_user" type="text" class="form-control" placeholder="fill name" required="required">
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Username</label>
                                <input id="addPosition" type="text" class="form-control" placeholder="fill username" name="username_user">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                              <label>Phone Number</label>
                                <input name="pno" class="form-control">
                                <span class="help-block"></span> 
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                              <label>Email</label>                       
                                <input name="email" class="form-control">
                                <span class="help-block"></span> 
                            </div>
                        </div>
                        <div class="col-md-6">                      
                            <div class="form-group form-group-default">
                              <label>Status</label>                      
                                <select name="status" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <span class="help-block"></span>
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
<div class="modal fade" id="editPass" role="dialog">
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
                <p class="small">Edit the details of the user using this form, make sure you fill them all</p>
                <form action="#" id="editPassForm">
                    <input type="hidden"  name="idPass"/>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Password</label>
                                <input name="pass" type="password" class="form-control" placeholder="fill password" required="required">
                            </div>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-md-12 pr-0">
                            <div class="form-group form-group-default">
                                <label>Confirm Password </label>
                                <input type="password" class="form-control" placeholder="fill confirm password" name="conpass">
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" id="btnSave" onclick="savePass()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>