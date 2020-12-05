<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;
class Posts extends Migration
{
	public function up()
	{
		 $this->forge->addField([
                        'post_id'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                                'comment' => 'ai,pk',
                        ],
                        'post_title'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                                'comment' => 'post title',
                        ],
                        'post_user_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'comment' => 'user id',
                        ],
                        'post_description' => [
                                'type'           => 'TEXT',
                                'null'           => true,
                                'comment' => 'post description',
                        ],
                        'post_status' => [
                                'type'           => 'INT',
                                'default'           => 0,
                                'comment' => 'post status 0=>pending,1=>published,2=>deled',
                        ],
                ]);
                $this->forge->addKey('post_id', true);
                $this->forge->createTable('posts');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('posts',TRUE);
	}
}
