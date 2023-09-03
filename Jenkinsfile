pipeline {
    options {
        timestamps()
        skipDefaultCheckout()
    }
    agent {
        node { label 'internal-build.ncats'}
    }
    triggers {
        pollSCM('H/5 * * * *')
    }
    parameters {
        string(name: 'BUILD_VERSION', defaultValue: '', description: '')
    }
    environment {
        PROJECT_NAME = "probes"
        DOCKER_REPO_NAME = "registry.ncats.nih.gov:5000/probes"
    }
    stages {
        stage('Build Version'){
            when { expression { BUILD_VERSION == '' } }
            steps{
                script {
                    BUILD_VERSION_GENERATED = VersionNumber(
                        versionNumberString: 'v${BUILD_YEAR, XX}.${BUILD_MONTH, XX}${BUILD_DAY, XX}.${BUILDS_TODAY}',
                        projectStartDate:    '1970-01-01',
                        skipFailedBuilds:    true)
                    currentBuild.displayName = BUILD_VERSION_GENERATED
                    env.BUILD_VERSION = BUILD_VERSION_GENERATED
                    env.BUILD = 'true'
                }
            }
        }
        stage('Checkout code') {
            steps {
                checkout scm
            }
        }
        stage('Build image') {
            when { expression { return env.BUILD == 'true' }}
            steps {
                script {
                    docker.withRegistry("https://registry.ncats.nih.gov:5000", "564b9230-c7e3-482d-b004-8e79e5e9720a") {
                        def img = docker.build("${DOCKER_REPO_NAME}:${BUILD_VERSION}", "--build-arg SOURCE_FOLDER=./${BUILD_VERSION} --no-cache ./")
                        img.push("${BUILD_VERSION}")
                        return img.id
                    }
                }
            }
        }
        stage('deploy docker') {
            agent {
                node { label 'ncatsldvoamnews01.ncats'}
            }
            steps {
                cleanWs()
                checkout scm
                configFileProvider([
                    configFile(fileId: 'probes-compose-file', targetLocation: 'docker-compose.yml'),
                    configFile(fileId: 'htaccess', targetLocation: 'htaccess'),
                    configFile(fileId: 'uploads.ini', targetLocation: 'uploads.ini'),
                    configFile(fileId: 'probes-wp-config.php', targetLocation: 'wp-config.php'),
                    configFile(fileId: 'wp-install-plugins.sh', targetLocation: 'wp-install-plugins.sh')
                ]) {
                    script {
                            def wp = new org.labshare.Wordpress()
                            wp.deployWP()
                    }
                    // For WP-CRON function
                    sh '''
                    echo HOST=probes-dev.ncats.nih.gov > hosts
                    NGINX_IP=`docker inspect -f "{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}" nginx` && echo NGINX_IP=$NGINX_IP >> hosts
                    source ./hosts && docker exec ncatsintranet_wordpress_1 sh -c "echo '$NGINX_IP $HOST' >> /etc/hosts"
                    '''
                }
            }
        }
    }
    post {
        always {
            slackSend channel:'#build-notifications',
            color: 'good',
            message: "${env.BUILD_URL} has result ${currentBuild.result}"
        }
    }
}
