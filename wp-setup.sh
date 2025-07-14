#!/bin/bash

echo "⏳ Waiting for MySQL to be ready..."

# 最大30回（60秒間）までチェック
for i in {1..30}; do
  wp db check --path=/var/www/html --allow-root && break
  echo "  🔄 DB not ready yet... retrying ($i/30)"
  sleep 2
done

# 最終チェック
if ! wp db check --path=/var/www/html --allow-root; then
  echo "❌ Could not connect to the database. Exiting
