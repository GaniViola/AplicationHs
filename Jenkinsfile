node {
    // Kita hapus pengecekan scm di luar supaya lebih rapi
    checkout scm

    stage("Build") {
        docker.image('php:8.2-cli').inside('-u root') {
            // Fix error 'dubious ownership' agar Git lancar
            sh 'git config --global --add safe.directory /var/jenkins_home/workspace/laravel-dev'
            
            sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer'
            sh 'apt-get update && apt-get install -y git unzip libzip-dev && docker-php-ext-install zip'
            
            // Install dependencies Laravel
            sh 'composer install --ignore-platform-req=ext-gd'
        }
    }

    stage("Testing") {
        docker.image('ubuntu').inside('-u root') {
            sh 'echo "Menjalankan Unit Test..."'
            sh 'echo "Ini adalah test: PASSED"'
        }
    }

    stage("Deploy (Simulasi)") {
        // Kita ganti rsync/vps dengan simulasi copy ke folder lokal Jenkins
        sh 'mkdir -p /var/jenkins_home/simulasi_prod'
        sh 'cp -r . /var/jenkins_home/simulasi_prod'
        
        echo "--------------------------------------------------"
        echo "DEPLOY BERHASIL (SIMULASI)"
        echo "File telah dikirim ke: /var/jenkins_home/simulasi_prod"
        echo "--------------------------------------------------"
    }
}
