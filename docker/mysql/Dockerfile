FROM mysql:8.0.16
LABEL maintainer "ucan"

COPY conf.d/mysql.cnf /etc/mysql/conf.d/mysql.cnf
RUN set -eux && \
 mkdir /var/lib/mysql-files
