create database IF NOT EXISTS myDb;

use myDb;

create table IF NOT EXISTS exads_test (
    id          integer   PRIMARY KEY AUTO_INCREMENT,
    name        text      NOT NULL,
    age         integer,
    job_title   text
  )
  CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE=InnoDB;

insert into exads_test (
    name,
    age,
    job_title
  ) values(
    'Rimom Costa',
    '35',
    'PHP Developer'
    ),(
    'Joao Jacome',
    '27',
    'Senior Software Engineer'
    );