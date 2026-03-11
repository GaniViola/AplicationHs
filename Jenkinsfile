node {
    checkout scm

    stage("Build") {
        docker.image('php:8.2-cli').inside('-u root') {
            sh 'apt-get update'
            sh 'apt-get install -y git unzip libzip-dev'
            sh 'docker-php-ext-install zip'
            sh 'git config --global --add safe.directory /var/jenkins_home/workspace/laravel-dev'
            sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer'
            sh 'composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-gd'
        }
    }

    stage("Testing") {
        docker.image('ubuntu').inside('-u root') {
            sh 'echo "Ini adalah test"'
        }
    }

    stage("Deploy") {
        docker.image('agung3wi/alpine-rsync:1.1').inside('-u root') {
            sshagent(credentials: ['ssh-prod']) {
                sh 'mkdir -p ~/.ssh'
                sh 'ssh-keyscan -H "$PROD_HOST" > ~/.ssh/known_hosts'
                sh 'rsync -rav --delete ./ ubuntu@$PROD_HOST:/home/ubuntu/prod.kelasdevops.xyz/ --exclude=.env --exclude=storage --exclude=.git'
            }
        }
    }
}
