<?php
  if(count($data) <= 0) {
    ?>
    <div class="nNote nFailure hideit">
        <p><strong>FAILURE: </strong>Oops sorry. 0 Results</p>
    </div>
    <?php
  } else {
    ?>
      <ul class="partners" >
        <?php foreach($data as $data): ?>
        <li>
            <?php
              if($data['File']['mime_type'] == "image/gif") {
                ?>
                <a rel="lightbox" title="<?php echo $data[$ModelName]['title'] ?>" href="<?php echo $data["File"]["host"].$data["File"]["url"]?>?time=<?php echo time()?>" style="border:0px;" class="floatL">
                <img src="<?php echo $data["File"]["host"].$data["File"]["url"]?>?time=<?php echo time()?>" width="40"/>
                </a>
                <?php
              } else {
                ?>
                <a rel="lightbox" title="<?php echo $data[$ModelName]['title'] ?>" href="<?php echo $data["File"]["host"].$data["File"]["url"]?>?time=<?php echo time()?>" style="border:0px;" class="floatL">
                <img src="<?php echo $data["File"]["host"].$data["File"]["url_thumb"]?>?time=<?php echo time()?>" width="40"/>
                </a>
                <?php
              }
            ?>
            <div class="pInfo floatL">
                <a href="#" title=""><strong><?php echo $data['File']['title']; ?></strong></a>
                <i><input type="text" value="<?php echo $data["File"]["host"].$data["File"]["url"]; ?>" readonly="readonly" /></i>
            </div>
        </li>
        <?php endforeach; ?>
      </ul>
    <?php
  }
?>
