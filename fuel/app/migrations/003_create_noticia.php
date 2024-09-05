<?php

namespace Fuel\Migrations;

class Create_noticia
{
	public function up()
	{
		\DBUtil::create_table('noticia', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'id_vitrine' => array('constraint' => 11, 'type' => 'int'),
			'id_galeria' => array('constraint' => 11, 'type' => 'int'),
			'tipo' => array('constraint' => 32, 'type' => 'varchar'),
			'titulo' => array('constraint' => 250, 'type' => 'varchar'),
			'descricao' => array('type' => 'text'),
			'imagem' => array('constraint' => 100, 'type' => 'varchar'),
			'imagem_peso' => array('constraint' => 100, 'type' => 'varchar'),
			'imagem_formato' => array('constraint' => 100, 'type' => 'varchar'),
			'imagem_tamanho' => array('constraint' => 100, 'type' => 'varchar'),
			'slug' => array('constraint' => 250, 'type' => 'varchar'),
			'texto' => array('type' => 'text'),
			'data_publicacao' => array('constraint' => 11, 'type' => 'int'),
			'exibir_home' => array('constraint' => 11, 'type' => 'int'),
			'data_exibir_home' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('noticia');
	}
}