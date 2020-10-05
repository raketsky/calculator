<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201003153131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create Calculation Record table';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE calculation_record (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  calculation_operation char(3) NOT NULL,
  number_a double NOT NULL,
  number_b double NOT NULL,
  result_value double DEFAULT NULL,
  created_at datetime NOT NULL,
  updated_at datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE calculation_record');
    }
}
