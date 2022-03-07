<!doctype html>
<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>KONECTA</title>
      <link href="<?=asset('bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
      <link href="<?=asset('angular-ui-notification.min.css','js/angular-assets')?>" rel="stylesheet" type="text/css" />
      <link href="<?=asset('crud.css')?>" rel="stylesheet" type="text/css" />
      <script src="<?=asset('jquery.js') ?>"></script>
      <script src="<?=asset('underscore.min.js') ?>"></script>
    	<script src="<?=asset('bootstrap.min.js') ?>"></script>
      <script src="<?=asset('angular/angular.min.js') ?>"></script>
      <script src="<?=asset('angular-assets/angular-ui-router.min.js', '') ?>"></script>
      <script src="<?=asset('angular-assets/angular-resource.min.js') ?>"></script>
      <script src="<?=asset('angular-assets/angular-ui-notification.min.js') ?>"></script>
      <script src="<?=asset('angular-assets/angular-messages.min.js') ?>"></script>
      <script src="<?=asset('angular-assets/angular-mocks.js') ?>"></script>
      <script src="<?=asset('angular-assets/angular-animate.min.js') ?>"></script> 
      <script src="<?=asset('angular-assets/angular-sanitize.js') ?>"></script> 
      <?if(isset($templates)){
        echo $templates;        
      }?>
      <script>
        const site_url = "<?=site_url()?>";
        const base_url = "<?=base_url()?>";
      </script>
    </head>
    <body ng-app='app_crud'>
          <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">KONECTA</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=base_url()?>">
                      KONECTA Codeigniter
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      
                    </ul>
                </div>
            </div>
        </nav>
    	<div class="workshop">
					<div class="title">
					<?if(isset($title)){
            echo $title;        
          }?>
					</div>
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