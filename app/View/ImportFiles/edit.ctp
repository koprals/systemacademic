<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Upload File</h5>
        </div>
        <div class="middleNav">
	        <ul>
				<li class="mUser">
					<a href="<?php echo $settings["cms_url"].$ControllerName ?>" title="View List"><span class="list"></span></a>
				</li>
	        </ul>
	    </div>
    </div>
</div>
<div class="line"></div>
<div class="wrapper">
	<div class="fluid">
    <div class="users form span4">
      <!-- Purchase info widget -->
      <div class="widget">
          <div class="title">
          	<img src="<?php echo $this->webroot ?>img/icons/dark/money.png" alt="" class="titleIcon" />
              <h6>File info</h6>
          </div>
          <div class="newOrder">
              <div class="userRow" style="text-align:center">
                  <a rel="lightbox" title="<?php echo $detail[$ModelName]['title'] ?>" href="<?php echo $detail["File"]["host"].$detail["File"]["url"]?>?time=<?php echo time()?>" style="border:0px;">
                  <img src="<?php echo $detail["File"]["host"].$detail["File"]["url_thumb"]?>?time=<?php echo time()?>" width="100"/>
                  </a>
              </div>
              <div class="cLine"></div>

              <div class="orderRow">
                  <ul>
                      <?php
                        if( $detail['File']['mime_type'] == "video/mp4") {
                          ?>
                            <li><b>File url : </b><?php echo wordwrap($detail["File"]["video_url"], 40,"<br />\n", true); ?></li>
                          <?php
                        } else {
                          ?>
                            <li><b>File url : </b><?php echo wordwrap($detail["File"]["host"].$detail["File"]["url"], 40,"<br />\n", true); ?></li>
                          <?php
                        }
                      ?>
                      <li><b>File type : </b><?php echo $detail['File']['mime_type'] ?></li>
                      <?php
                        if(isset($fileinfo['height'])) {
                          ?>
                          <li><b>File dimension : </b><?php echo $fileinfo['width']."x".$fileinfo['height']; ?></li>
                          <?php
                        }
                      ?>
                      <?php
                        if(isset($fileinfo['file_size'])) {
                          ?>
                          <li><b>File size : </b><?php echo $fileinfo['file_size']." Kb"; ?></li>
                          <?php
                        }
                      ?>
                  </ul>
              </div>
          </div>
      </div>
		</div>
		<div class="users form span8">
			<?php echo $this->Form->create($ModelName, array('url' => array("controller"=>$ControllerName,"action"=>"Edit", $ID),'class' => 'form',"type"=>"file")); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Edit File</h6>
						</div>
						<?php $ModelName?>
						<?php
              echo $this->Form->input('id');
							echo $this->Form->input('title', array(
                'type'      =>  'text',
								'label'			=>	'Title / Alt Text (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
						?>

						<div class="formSubmit">
							<input type="submit" value="Submit" class="redB" />
							<input type="button" value="Cancel" class="blackB" onclick="location.href = '<?php echo $settings["cms_url"].$ControllerName?>/Index'"/>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
