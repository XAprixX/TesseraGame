<?php
session_start();
include_once("Conexão.php");
  // Verifique se o parâmetro 'user_id' está presente na URL
if (isset($_GET['user_id'])) {

    // Recupere o ID do usuário da URL
    $userId = $_GET['user_id'];
    } else {
        echo "Você não está logado.";
    }
      // Consulta SQL para obter os valores de money, hunger, happiness e wisdom
      $getStatsQuery = "SELECT happiness FROM usuario WHERE ID = ?";
      $stmt = $conn->prepare($getStatsQuery);
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $statsResult = $stmt->get_result();

      if ($statsResult->num_rows > 0) {
        $statsRow = $statsResult->fetch_assoc();
      $happiness = $statsRow['happiness'];

      echo "<script>var happiness = " . (isset($_SESSION['happiness']) ? $_SESSION['happiness'] : 0) . ";</script>";
        }
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<title>Basquete</title>
	<script type="text/javascript" src="js/phaser.min.js"></script>
	<link rel="stylesheet" href="Styles.css">
	<h2>Basquete</h2>

</head>

<body>

	<script type="text/javascript">
		var game = new Phaser.Game(400, 625, Phaser.CANVAS, '', {
			preload: preload,
			create: create,
			update: update
		});

		function preload() {

			game.load.image('ball', 'assets/images/ball.png');
			game.load.image('hoop', 'assets/images/hoop.png');
			game.load.image('side rim', 'assets/images/side_rim.png');
			game.load.image('front rim', 'assets/images/front_rim.png');
			game.load.image('background', 'Quadra.jpg'); // Substitua 'caminho/para/sua/imagem.jpg' pelo caminho correto para sua imagem de fundo.


		}

		var hoop,
			left_rim,
			right_rim,
			ball,
			front_rim,
			current_score = 0,
			current_score_text,
			high_score = 0,
			high_score_text,
			miss = 0,
			current_miss_text,
			current_miss,
			current_best_text;

		var collisionGroup;

		function create() {

			game.physics.startSystem(Phaser.Physics.P2JS);

			game.physics.p2.setImpactEvents(true);

			game.physics.p2.restitution = 0.63;
			game.physics.p2.gravity.y = 0;

			collisionGroup = game.physics.p2.createCollisionGroup();
			game.stage.backgroundColor = "#808080";



			current_score_text = game.add.text(187, 312, '', {
				font: 'Arial',
				fontSize: '40px',
				fill: '#000',
				align: 'center'
			});
			current_best_text = game.add.text(143, 281, '', {
				font: 'Arial',
				fontSize: '20px',
				fill: '#000',
				align: 'center'
			});
			current_best_score_text = game.add.text(187, 312, '', {
				font: 'Arial',
				fontSize: '40px',
				fill: '#00e6e6',
				align: 'center'
			});
			current_miss = game.add.text(270, 230, '', {
				font: 'Arial',
				fontSize: '40px',
				fill: '#000',
				align: 'center'
			});
			current_miss_text = game.add.text(150, 230, '', {
				font: 'Arial',
				fontSize: '40px',
				fill: '#000',
				align: 'center'
			});

			hoop = game.add.sprite(88, 62, 'hoop');
			left_rim = game.add.sprite(150, 184, 'side rim');
			right_rim = game.add.sprite(249, 184, 'side rim');

			game.physics.p2.enable([left_rim, right_rim], false);

			left_rim.body.setCircle(2.5);
			left_rim.body.static = true;
			left_rim.body.setCollisionGroup(collisionGroup);
			left_rim.body.collides([collisionGroup]);

			right_rim.body.setCircle(2.5);
			right_rim.body.static = true;
			right_rim.body.setCollisionGroup(collisionGroup);
			right_rim.body.collides([collisionGroup]);

			createBall();

			cursors = game.input.keyboard.createCursorKeys();

			game.input.onDown.add(click, this);
			game.input.onUp.add(release, this);
		}

		function update() {

			if (ball && ball.body.velocity.y > 0) {
				front_rim = game.add.sprite(148, 182, 'front rim');
				ball.body.collides([collisionGroup]);
			}

			if (ball && ball.body.velocity.y > 0 && ball.body.y > 188 && !ball.isBelowHoop) {
				ball.isBelowHoop = true;
				ball.body.collideWorldBounds = false;

				if (ball.body.x > 151 && ball.body.x < 249) {
					//acertou
					current_score += 1;
					current_score_text.text = current_score;

				} else {
					//errou
					if (current_score > high_score) {
						high_score = current_score;
					}
					
					miss++;

					current_score = 0;
					current_score_text.text = '';

					current_miss_text.text = "Erros: ";
					current_miss.text = miss;

					current_best_text.text = 'Recorde atual';
					current_best_score_text.text = high_score;

					if (miss == 3) {

						setTimeout(() => {
							if (high_score == 1) {
								alert("Você perdeu!! Seu recorde foi de " + high_score + " cesta.")
							} else {
								alert("Você perdeu!! Seu recorde foi de " + high_score + " cestas seguidas.");
							}
						}, 10);

					
						updateHappiness();


						//window.history.back();

					}

				}

			}

			if (ball && ball.body.y > 1200) {
				game.physics.p2.gravity.y = 0;
				ball.kill();
				createBall();
			}

		}

		function tweenOut() {
			moveOutTween = game.add.tween(emoji).to({
				y: 50
			}, 600, Phaser.Easing.Elastic.In, true);
			moveOutTween.onComplete.add(function () {
				emoji.kill();
			}, this);
			setTimeout(function () {
				fadeOutTween = game.add.tween(emoji).to({
					alpha: 0
				}, 300, Phaser.Easing.Linear.None, true, 0, 0, false);
			}, 450);
		}

		function createBall() {

			var xpos;
			if (current_score === 0) {
				xpos = 200;
			} else {
				xpos = 60 + Math.random() * 280;
			}
			ball = game.add.sprite(xpos, 547, 'ball');
			game.add.tween(ball.scale).from({
				x: 0.7,
				y: 0.7
			}, 100, Phaser.Easing.Linear.None, true, 0, 0, false);
			game.physics.p2.enable(ball, false);
			ball.body.setCircle(60);
			ball.launched = false;
			ball.isBelowHoop = false;
		}

		var location_interval;
		var isDown = false;
		var start_location;
		var end_location;

		function click(pointer) {

			var bodies = game.physics.p2.hitTest(pointer.position, [ball.body]);
			if (bodies.length) {
				start_location = [pointer.x, pointer.y];
				isDown = true;
				location_interval = setInterval(function () {
					start_location = [pointer.x, pointer.y];
				}.bind(this), 200);
			}

		}

		function release(pointer) {

			if (isDown == true) {
				window.clearInterval(location_interval);
				isDown = false;
				end_location = [pointer.x, pointer.y];

				if (end_location[1] < start_location[1]) {
					var slope = [end_location[0] - start_location[0], end_location[1] - start_location[1]];
					var x_traj = -2300 * slope[0] / slope[1];
					launch(x_traj);
				}
			}

		}

		function launch(x_traj) {

			if (ball.launched === false) {
				ball.body.setCircle(36);
				ball.body.setCollisionGroup(collisionGroup);
				current_best_text.text = '';
				current_best_score_text.text = '';
				ball.launched = true;
				game.physics.p2.gravity.y = 3000;
				game.add.tween(ball.scale).to({
					x: 0.6,
					y: 0.6
				}, 500, Phaser.Easing.Linear.None, true, 0, 0, false);
				ball.body.velocity.x = x_traj;
				ball.body.velocity.y = -1750;
				ball.body.rotateRight(x_traj / 3);
			}

		}
		function updateHappiness() {
    		// Faça uma solicitação AJAX ou Fetch para o script PHP
    		fetch('updateHappiness.php')
        	.then(response => response.text())
        	.then(data => {
            	console.log('Felicidade atualizada no banco de dados');
        	})
        	.catch(error => {
            console.error('Erro ao atualizar felicidade:', error);
        	});
		}
	</script>

</body>

</html>