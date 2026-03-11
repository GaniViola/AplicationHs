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
            sshagent(credentials: ['ubuntu']) { // <-- samakan dengan nama credential di Jenkins
                sh 'mkdir -p ~/.ssh && chmod 700 ~/.ssh'
                sh 'ssh-keyscan -H 13.248.169.48 >> ~/.ssh/known_hosts && chmod 600 ~/.ssh/known_hosts'
                sh '''
                    rsync -avz --delete \
                        --exclude='.env' \
                        --exclude='storage' \
                        --exclude='.git' \
                        ./ ubuntu@13.248.169.48:/home/ubuntu/prod.kelasdevops.xyz/
                '''
            }
        }
    }
}
