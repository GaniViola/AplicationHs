node {
    checkout scm

    def prodHost = '192.168.1.1'

    stage("Build") {
        docker.image('php:8.2-cli').inside('-u root') {
            sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer'
            sh 'apt-get update && apt-get install -y git unzip libzip-dev && docker-php-ext-install zip'
            sh 'composer install --ignore-platform-req=ext-gd'
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
                sh "ssh-keyscan -H ${prodHost} > ~/.ssh/known_hosts"
                sh "rsync -rav --delete ./laravel/ ubuntu@${prodHost}:/home/ubuntu/prod.kelasdevops.xyz/ --exclude=.env --exclude=storage --exclude=.git"
            }
        }
    }
}
