FROM wordpress:latest

# WP-CLIをインストール
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    curl \
    && rm -rf /var/lib/apt/lists/*

# セットアップスクリプトをコピー
COPY wp-setup.sh /wp-setup.sh
RUN chmod +x /wp-setup.sh

# 自作テーマをコピー
COPY wp-data/wp-content/themes/my-theme /var/www/html/wp-content/themes/my-theme/

# ポート80を公開
EXPOSE 80

# ヘルスチェック
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# 起動コマンド
CMD ["apache2-foreground"] 