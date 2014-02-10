title: "Install AWS Command Line Tools Using Homebrew"

published: 2013-11-22T12:00:00+3:00

type: own-post

content: |-

    <pre class="brush: bash">
    $ brew install auto-scaling
    $ brew install aws-cfn-tools
    $ brew install aws-elasticache
    $ brew install aws-elasticbeanstalk
    $ brew install aws-iam-tools
    $ brew install aws-sns-cli
    $ brew install cloud-watch
    $ brew install ec2-ami-tools
    $ brew install ec2-api-tools
    $ brew install elb-tools
    $ brew install rds-command-line-tools
    </pre>

    Add these to your environment ...

    <pre class="brush: bash">
    export JAVA_HOME="$(/usr/libexec/java_home)"
    export EC2_PRIVATE_KEY="$(/bin/ls "$HOME"/.ec2/pk-*.pem | /usr/bin/head -1)"
    export EC2_CERT="$(/bin/ls "$HOME"/.ec2/cert-*.pem | /usr/bin/head -1)"
    export AWS_AUTO_SCALING_HOME="/usr/local/Cellar/auto-scaling/1.0.61.3/libexec"
    export AWS_CLOUDFORMATION_HOME="/usr/local/Cellar/aws-cfn-tools/1.0.12/libexec"
    export AWS_CREDENTIAL_FILE="<Path to the credentials file>"
    export AWS_ELASTICACHE_HOME="/usr/local/Cellar/aws-elasticache/1.9.000/libexec"
    export AWS_ELB_HOME="/usr/local/Cellar/elb-tools/1.0.23.0/libexec"
    export EC2_HOME="/usr/local/Cellar/ec2-api-tools/1.6.12.0/libexec"
    export AWS_IAM_HOME="/usr/local/opt/aws-iam-tools/jars"
    export AWS_CREDENTIAL_FILE=$HOME/.aws-credentials-master
    export AWS_SNS_HOME="/usr/local/Cellar/aws-sns-cli/2013-09-27/libexec"
    export AWS_CLOUDWATCH_HOME="/usr/local/Cellar/cloud-watch/1.0.13.4/libexec"
    export SERVICE_HOME="$AWS_CLOUDWATCH_HOME"
    export EC2_AMITOOL_HOME="/usr/local/Cellar/ec2-ami-tools/1.4.0.9/libexec"
    export AWS_RDS_HOME="/usr/local/Cellar/rds-command-line-tools/1.14.001/libexec"
    </pre>

    Thanks to [this guy ...][1]

    [1]: http://clayrichardson.me/2013/03/29/brew-install-all-available-aws-tools/
