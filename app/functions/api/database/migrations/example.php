<?php

$database::statement('CREATE TABLE IF NOT EXISTS wp_examples(
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    PRIMARY KEY (id)
)');
