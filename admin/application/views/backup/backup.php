<div class="container dir-rtl">
	<div class="row">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">پشتیبان گیری</h3>
          </div>
          <div class="panel-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><p class="pull-right">تاریخ</p></th>
                        <th class="col-md-1 text-center"><p>دانلود</p></th>
                        <th class="col-md-1 text-center"><p>بازیابی</p></th>
                        <th class="col-md-1 text-center"><p>حذف</p></th> 
                    </tr>
                </thead>
                <?php foreach($file as $row):?>
                    <?php if($row['name']!='index.php'):?>
                        <tr>
                            <td><p class="pull-right dir-ltr"><?php echo $row['name'];?></p></td>
                            <td class="text-center"><p><?php echo btn_download('backupDownload/'.$row['name'])?></p></td>
                            <td class="text-center"><p><?php echo btn_restor('backupRestore/'.$row['name'])?></p></td>
                            <td class="text-center"><p><?php echo btn_delete('backupDelete/'.$row['name'])?></p></td>
                        </tr>
                    <?php endif?>
                <?php endforeach?>
            </table>          
          </div>
          <div class="panel-footer text-left">
          	<?php echo form_open('backup-create');?>	
                <button type="submit" class="btn btn-primary">پشتیبان گیری</button>
            <?php echo form_close();?>   
          </div>
        </div>    
    


</div>
</div>    

