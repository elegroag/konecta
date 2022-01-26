<!doctype html>
<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRUDCODE</title>
      <link href="<?=asset('bootstrap.min.css')?>" rel="stylesheet" type="text/css">
      <link href="<?=asset('angular-ui-notification.min.css','js/angular-assets')?>" rel="stylesheet" type="text/css">
      <link href="<?=asset('crud.css')?>" rel="stylesheet" type="text/css" />      
      <script src="<?=asset('jquery.js') ?>"></script>
      <script src="<?=asset('underscore.min.js') ?>"></script>
    	<script src="<?=asset('bootstrap.min.js') ?>"></script>
      <?if(isset($templates)){
        echo $templates;        
      }?>
      <script>
        const site_url = "<?=site_url()?>";
        const base_url = "<?=base_url()?>";
      </script>
    </head>
    <body ng-app='app_crud'>
          <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">CRUDCODE</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=base_url()?>">
                      CRUD Codeigniter
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <?if(!$this->session->userdata("on_session")){?>
                        <li><a href="<?=site_url()?>login">Login</a></li>
                        <li><a href="<?=site_url()?>register">Register</a></li>
                      <?}else{?>                   
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                <?=$this->session->userdata("username")?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?=site_url()?>logout">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                       <?}?>
                    </ul>
                </div>
            </div>
        </nav>
      </div>

    	<div class="workshop">
				<div class="container">
				<?if(isset($content)){
          echo $content;        
        }?>
				</div>
    	</div>
      <?if(isset($scripts)){
        echo $scripts;        
      }?>
    </body>
<script type="text/javascript">
<?
  if($show = $this->session->flashdata("result")){
    if(is_array($show)){
      if($show["status"] == 200 || $show["status"] == 404){?>
        alert("<?=$show["response"]?>");
<?    }
    }
  }
?>
</script>     
</html>