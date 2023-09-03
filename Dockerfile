#Base operating System
FROM library/wordpress:latest

#install wp-cli
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    chmod +x wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/wp

# Install Postfix.
RUN apt-get update -y && \
      echo "postfix postfix/main_mailer_type string Internet site" > preseed.txt && \
      echo "postfix postfix/mailname string ncats.nih.gov" >> preseed.txt && \
# Use Mailbox format.
      debconf-set-selections preseed.txt && \
      DEBIAN_FRONTEND=noninteractive apt-get install -q -y postfix

# Install Ghostscript & ImageMagick
RUN apt-get update -y
RUN apt-get install -y ghostscript
RUN apt-get install -y imagemagick

RUN echo "sendmail_path=sendmail -t -i" >> /usr/local/etc/php/conf.d/sendmail.ini \
 && echo '#!/bin/bash' >> /usr/local/bin/docker-entrypoint-wrapper.sh \
 && echo 'service postfix restart' >> /usr/local/bin/docker-entrypoint-wrapper.sh \
 && echo 'exec docker-entrypoint.sh "$@"' >> /usr/local/bin/docker-entrypoint-wrapper.sh \
 && chmod +x /usr/local/bin/docker-entrypoint-wrapper.sh

# Install packages: wget
RUN apt-get install -y wget

#copy built files to WordPress files system
COPY telow-client/  /var/www/html/wp-content/plugins/telow-client/

CMD ["apache2-foreground"]
