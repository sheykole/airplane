<script type="text/javascript">
function edit(id = null)
{   

    $('#edit')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    if(id == null)
    {
         $('#editform').modal('show'); // show bootstrap modal
         $('.modal-title').text('Add Schedule'); // Set Title to Bootstrap modal title
    }
    else
    {
        $.ajax({
                url : "<?php echo site_url('admin/schedule_edit/')?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    
                    $('[name="id"]').val(data.schedulenum);
                    $('[name="flightnum"]').val(data.flightnum);
                    $('[name="arr_time"]').val(data.arr_time);
                    $('[name="dep_time"]').val(data.dep_time);
                    $('[name="arr"]').val(data.arr);
                    $('[name="des"]').val(data.des);
                    $('[name="airplaneid"]').val(data.airplaneid);
                    $('[name="capacity"]').val(data.capacity);
                    $('#editform').modal('show'); // show bootstrap modal
                    $('.modal-title').text('Edit Schedule'); // Set Title to Bootstrap modal title
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
        url = "<?php echo site_url('admin/rating_update')?>";
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

                <h4 class="mt-0 header-title">List of Schedules <button type="button" class="btn btn-primary btn-xs" data-original-title="Edit User" onclick="edit()">
                                    Add Schedule</i>
                                </button></h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>S/NO</th>
                            <th>Flight</th>
                            <th>Arr. time</th>
                            <th>Dep.. time</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Airplane</th>
                            <th>Capacity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result != '') { $i=0; foreach($result as $r){ 
                            ?>
                            <tr>
                                <td><?=$i+=1;?></td>
                                <td><?=$r->flightnum;?></td>
                                <td><?=$r->arr_time;?></td>
                                <td><?=$r->dep_time;?></td>
                                <td><?=$r->arr;?></td>
                                <td><?=$r->des;?></td>
                                <td><?=dbInfo('airplane_m','numser',$r->airplaneid,'manufacturer').' '.dbInfo('airplane_m','numser',$r->airplaneid,'model');?></td>
                                <td><?=$r->capacity;?></td>
                                <td>
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs" data-original-title="Edit User" onclick="edit(<?=$r->schedulenum;?>)">
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
                <p class="small">Edit the details of the airplane using this form, make sure you fill them all</p>
                <form action="#" id="edit">
                    <input type="hidden"  name="id"/>
                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Flight</label>
                                <select name="flightnum" class="form-control">
                                <option value="">--SELECT--</option>
                                <?php foreach ($flight as $key) { ?>
                                <option value="<?=$key->flightnum;?>"><?=$key->origin.' '.$key->destination;?></option>
                               <?php  } ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Arr. Time</label>
                                <input id="addName" name="arr_time" type="time" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Dep. Time</label>
                                <input id="addName" name="dep_time" type="time" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Origin</label>
                                <input id="addName" name="arr" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Destination</label>
                                <input id="addName" name="des" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Airplane</label>
                                <select name="airplaneid" class="form-control">
                                <option value="">--SELECT--</option>
                                <?php foreach ($airplane as $key) { ?>
                                <option value="<?=$key->numser;?>"><?=$key->manufacturer.' '.$key->model;?></option>
                               <?php  } ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Capacity</label>
                                <input id="addName" name="capacity" type="text" class="form-control" required="required">
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