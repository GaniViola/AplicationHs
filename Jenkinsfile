node {
    checkout scm

    stage("Build") {
        docker.image('php:8.2-cli').inside('-u root') {
            // Baris ini harus UTUH sampai selesai
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
                // Pastikan bagian >> ~/.ssh/known_hosts tertulis LENGKAP
                sh 'ssh-keyscan -H 13.248.169.48 >> ~/.ssh/known_hosts'
                
                // Pastikan path tujuan rsync tertulis LENGKAP
                sh 'rsync -rav --delete ./ ubuntu@13.248.169.48:/home/ubuntu/prod.kelasdevops.xyz/ --exclude=.env --exclude=storage --exclude=.git'
            }
        }
    }
}
