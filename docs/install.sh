#!/usr/bin/env bash

PROJ_NAME="$1"
mkdir -p "$PROJ_PATH"
cd "$PROJ_PATH" || exit
composer require tivins/baz-core
mkdir src/"$PROJ_NAME"
{
    echo "<?php"; \
    echo "class Schema extends \Tivins\baz\install\Schema {"; \
    echo "    public function build(): static {"; \
    echo "        \$this->setMembers("; \
    echo "            // "; \
    echo "        );"; \
    echo "    }"; \
    echo "}"; \
} > src/"$PROJ_NAME"/Schema.php
