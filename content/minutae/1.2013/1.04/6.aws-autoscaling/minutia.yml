title: "Autoscaling on EC2 with ELB &amp; Cloudwatch on Ubuntu"

published: 2013-04-22T12:00:00+3:00

type: own-post

content: |-

    _Please note that this is not a detailed guide ... relevant links are
    included if you want detail. The objective is to highlight the key steps or
    rather, the 'points-to-note 'throughout the process. A LOT is assumed._

    ###Basic Expected Setup###

    The first obvious assumption is that you are running Ubuntu. Running [Ubuntu
    Cloud Guest][link31] on [Amazon Web Services][aws] requires you to go
    through the following steps;

    1. Create your account on Amazon (if you do not already have one) and setup your credentials - [Getting Started With Aws][link26]
    2. [Install Amazon EC2 API Tools][ubuntuec2guide]
    3. Instantiate your [images(s)][link28]
    4. Configure your [instance][link27]

    Details of the above steps can be [found here][ubuntuec2guide] ... though
    they seem a bit complicated due to reliance on the CLI, but if its any
    consolation, _some_ of the tasks can be done via the [Amazon Web
    Console][awsconsole].

    Double check you have the following environment variables set up in your
    shell profile. You should have something close to ... (see below code block)
    ... in your `~/.bashrc` if you use bash as your shell.

    <pre class="brush: plain">
    # WHERE YOUR JAVA IS
    export JAVA_HOME=/usr

    ##################
    ## Amazon Paths ##
    ##################

    # Set variables for each service
    export EC2_HOME=/usr/local/aws/ec2
    export AWS_IAM_HOME=/usr/local/aws/iam
    export AWS_RDS_HOME=/usr/local/aws/rds
    export AWS_ELB_HOME=/usr/local/aws/elb
    export AWS_CLOUDFORMATION_HOME=/usr/local/aws/cfn
    export AWS_AUTO_SCALING_HOME=/usr/local/aws/as
    export CS_HOME=/usr/local/aws/cloudsearch
    export AWS_CLOUDWATCH_HOME=/usr/local/aws/cloudwatch
    export AWS_ELASTICACHE_HOME=/usr/local/aws/elasticache
    export AWS_SNS_HOME=/usr/local/aws/sns
    export AWS_ROUTE53_HOME=/usr/local/aws/route53
    export AWS_CLOUDFRONT_HOME=/usr/local/aws/cloudfront

    # This iterates through the list passed into it and sets the PATHs
    for i in $EC2_HOME $AWS_IAM_HOME $AWS_RDS_HOME $AWS_ELB_HOME   $AWS_CLOUDFORMATION_HOME $AWS_AUTO_SCALING_HOME $CS_HOME   $AWS_CLOUDWATCH_HOME $AWS_ELASTICACHE_HOME $AWS_SNS_HOME   $AWS_ROUTE53_HOME $AWS_CLOUDFRONT_HOME /usr/local/aws/s3
    do
      PATH=$i/bin:$PATH
    done
    PATH=/usr/local/aws/elasticbeanstalk/eb/linux/python2.7:$PATH
    PATH=/usr/local/aws/elasticmapreduce:$PATH

    ########################
    ## Amazon Credentials ##
    ########################

    # Choose whatever path, in this case it is `$HOME/.aws/...` this then set
    # the relevant paths for authentification stuff
    export EC2_PRIVATE_KEY=$(echo $HOME/.aws/pk-*.pem)
    export EC2_CERT=$(echo $HOME/.aws/cert-*.pem)
    export AWS_CREDENTIAL_FILE=$HOME/.aws/aws-credential-file.txt
    export ELASTIC_MAPREDUCE_CREDENTIALS=$HOME/.aws/aws-credentials.json
    </pre>

    Refresh environment variables after editing `~/.bashrc` file. Just to be
    sure.

    <pre class="brush: bash">
    source ~/.bashrc
    </pre>

    There's probably something I've left out but that's the general idea + the
    set up process is well documented online, [a simple google search should
    do][link12].

    _Ps: If you have services in other regions (from the US default) you have to
    set some URLs in the `~/.bashrc` file. Don't worry, keep reading ... I've
    mentioned this with a litlle more detail ahead._

    ###Adding Support For The Other Services###

    To put it simply, the [`ec2-api-tools`][link13] only install `ec2-*`
    commands.

    What I mean is that, after installing the api-tools you should have access
    to `ec2-*` type commands but no `as-*` (autoscaling), `elb-*` (elastic load
    balancer) etc. type commands - i.e. the other services. That's because you
    have to manually install them. Check the [AWS Developer
    Tools][awsdevelopertools] for official documentation on the tools, changelog
    &amp; download links or check out this [blog- post][link1]. Below is a list
    of commonly used API tools ...

    * [Amazon EC2 Command Line Tool][link3]
    * [Auto Scaling Command Line Tool][link4]
    * [Elastic Load Balancing Command Line Tool][link5]
    * [Amazon CloudWatch Command Line Tool][link22]

    Assuming you are the super user &amp; taking the Elastic Load Balanacer as
    an example, copy the files from the `bin/` &amp; `lib/` folders (you see
    them after unzipping the downloaded file) into the respective folder for the
    service as was seen in the `~/.bashrc` file earlier. Please note that after
    installing the `ec2-api-tools`, the `/usr/local/aws/` folder should not
    exist (unless you made them yourself) since its actually never been created.
    The following commands therefore should create the folders (with sub-
    folders) for you.

    <pre class="brush: bash">
    wget --quiet http://ec2-downloads.s3.amazonaws.com/ElasticLoadBalancing.zip
    unzip -qq ElasticLoadBalancing.zip
    rsync -a --no-o --no-g ElasticLoadBalancing-*/ /usr/local/aws/elb/
    </pre>

    And so on - repeat for each service that you wnat to add.

    Once your done, the commands for each service should now be available to
    your shell.

    Now we begin ...

    ###Configuring Autoscaling Using ELB &amp; EC2###

    ####Prerequisite 1: Create/Choose Custom AMI####

    If you haven’t created an AMI from one of your running EC2 instances, create
    one now, or click over to your AMIs page on the AWS Console to retrieve the
    AMI ID to be used as a template, and write it down. You’ll need an AMI ID
    later. Think of it as your autoscaling-instance-template.

    _Ps: If you already have a running EBS-backed instance, you can save this
    Amazon Machine Image (AMI) and autoscale with it ... [find steps on how to
    create your own AMIs here][link10]_

    ####Prerequisite 2: Set Up Your Your ELB####

    The ELB name that is displayed on the AWS Console will also be required at
    some point. You can use the AWS Console to [create an ELB][link32] if you
    don't have one. Once your ELB is up, you will most likely create a CNAME
    record at your DNS provider pointing your landing page or vanity domain to
    the DNS name given in the AWS Console. Visit ['Use Domain Names with Elastic
    Load Balancing'][link14] at Amazon AWS Documentation page for details on
    this.

    ####Prerequisite 3: Check Credentials/ Keys/ Authorizations Are In Order####

    Some services will fail if the credentials are not in order. Common mistake
    is to set the key &amp; secret and assume that's all that the other services
    require. For example, [check out the set up process for autoscaling][link18]
    ... it requires the `aws-credential-file.txt` that's referenced in
    `~/.bashrc`.

    When setting up the credential file, check in the unzipped folder of the
    service for the `credential-file-path.template` to use as a reference for
    your own credentials file.

    Also ... By default, the Auto Scaling command line interface (CLI) uses the
    Eastern United States Region (us-east-1) with the autoscaling.us-
    east-1.amazonaws.com service endpoint URL. If your instances are in a
    different region, you must specify the region where your instances reside by
    setting the AWS_AUTO_SCALING_URL environment variable.

    <pre class="brush: bash">
    $ export AWS_AUTO_SCALING_URL=https://autoscaling.eu-west-1.amazonaws.com
    </pre>

    Same as the ELB ...

    <pre class="brush: bash">
    $ export AWS_ELB_URL=https://elasticloadbalancing.eu-west-1.amazonaws.com
    </pre>

    Same as CloudWatch

    <pre class="brush: bash">
    $ export AWS_CLOUDWATCH_URL=https://monitoring.eu-west-1.amazonaws.com
    </pre>

    ####Step 1: Create An Elastic Load Balancer####

    That's if you haven't already ... [spend some time here][link32].

    ####Step 2: Create Launch Config####

    > The launch configuration specifies the template that Auto Scaling uses to
    > launch Amazon EC2 instances. This template contains all the information
    > necessary for Auto Scaling to launch instances that run your application.

    > A launch configuration is a template that the Auto Scaling group uses to
    > launch Amazon EC2 instances. You create the launch configuration by
    > including information such as the Amazon machine image ID to use for
    > launching the EC2 instance, the instance type, key pairs, security groups,
    > and block device mappings, among other configuration settings. When you
    > create your Auto Scaling group, you must associate it with a launch
    > configuration. You can attach only one launch configuration to an Auto
    > Scaling group at a time. Launch configurations cannot be modified. They
    > are immutable. If you want to change the launch configuration of your Auto
    > Scaling group, you have to first create a new launch configuration and
    > then update your Auto Scaling group by attaching the new launch
    > configuration. When you attach a new launch configuration to your Auto
    > Scaling group, any new instances will be launched using the new
    > configuration parameters. Existing instances are not affected.

    <pre class="brush: bash; highlight: [1]">
    $ as-create-launch-config AutoscaleLC --image-id ami-xxxxxxxxc --instance-type m1.small --group your-security-group --key ~/.aws/your-key.pem
    $ OK-Created launch config
    </pre>

    Don't forget to set the `--key YourKey` especially if you want to ssh into
    the instances ... you can get a list of your keys from here in case you
    don't remember.

    <pre class="brush: bash">
    $ ec2-describe-keypairs
    </pre>

    ####Step 3: Create an Auto Scaling Group####

    > An Auto Scaling group is a collection of Amazon EC2 instances. You can
    > specify settings like the minimum, maximum, and desired number of EC2
    > instances for an Auto Scaling group to which you want to apply certain
    > scaling actions.

    <pre class="brush: bash; highlight: [1]">
    $ as-create-auto-scaling-group AutoScalingGroup --availability-zones eu-west-1a --launch-configuration AutoscaleLC --min-size 1 --max-size 2 --load-balancers AutoscaleLB --desired-capacity 1 --default-cooldown 300 --grace-period 300 --health-check-type ELB
    $ OK-Created AutoScalingGroup
    </pre>

    ####Step 4: Scale Up &amp; Down####

    Scaling policie tells the Auto Scaling group what to do when the specified conditions change.

    <pre class="brush: bash">
    $ as-put-scaling-policy --auto-scaling-group AutoScalingGroup --name scale-up --adjustment 1 --type ChangeInCapacity --cooldown 300
    $ arn:aws:autoscaling:eu-west-1:xxxxxxxxxxxx:scalingPolicy:xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx:autoScalingGroupName/AutoscaleG:policyNameScaleUp
    </pre>

    Basic upscale policy defined, named “scale-up,” a ChangeInCapacity policy
    to add 1 server and wait 3 minutes before another policy can be triggered.
    Below is the reverse operation, or a “scale-down” policy to remove 1 server
    from the group.

    <pre class="brush: bash">
    $ as-put-scaling-policy --auto-scaling-group AutoScalingGroup --name scale-dn "--adjustment=-1" --type ChangeInCapacity --cooldown 300
    $ arn:aws:autoscaling:eu-west-1:xxxxxxxxxxxx:scalingPolicy:xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx:autoScalingGroupName/AutoscaleG:policyNameScaleUp
    </pre>

    For details on the possible variations that can be applied such as the
    various adjustment types you can [read this ...][link23]

    _Ps: Cooldown period is in seconds._

    ####Step 5: Link a CloudWatch event to an auto scaling policy####

    Use the CloudWatch command mon-put-metric-alarm to create an alarm to for
    increasing the size of the Auto Scaling group when the average CPU usage of
    all the instances goes up to 80 percent.

    <pre class="brush: bash">
    $ mon-put-metric-alarmScaleUpAlarm --alarm-description "Scale up at 80% load" --comparison-operator GreaterThanOrEqualToThreshold --evaluation-periods 2 --metric-name CPUUtilization --namespace "AWS/EC2" --period 120 --statistic Average --threshold 80 --alarm-actions arn:aws:autoscaling:eu-west-1:xxxxxxxxxxxx:scalingPolicy:xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx:autoScalingGroupName/AutoscaleG:policyNameScaleUp --dimensions "AutoScalingGroupName=AutoscaleG"
    $ OK-Created Alarm
    </pre>

    Use the CloudWatch command mon-put-metric-alarm to create an alarm for
    decreasing the size of the Auto Scaling group when the average CPU usage of
    all the instances goes down 40 percent.

    <pre class="brush: bash">
    $ mon-put-metric-alarmScaleDownAlarm --alarm-description "Scale down at 40% load" --comparison-operator LessThanOrEqualToThreshold --evaluation-periods 2 --metric-name CPUUtilization --namespace "AWS/EC2" --period 120 --statistic Average --threshold 40 --alarm-actions arn:aws:autoscaling:eu-west-1:xxxxxxxxxxxx:scalingPolicy:xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx:autoScalingGroupName/AutoscaleG:policyNameScaleDown --dimensions "AutoScalingGroupName=AutoscaleG"
    $ OK-Created Alarm
    </pre>

    You can create your own SNS notification for auto-scaling events from the
    console if you want ie. send an email when X happens. Create a topic via the
    console, this gives you an ARN something like this
    `arn:aws:sns:************************`

    <pre class="brush: bash">
    $ as-put-notification-configuration --topic-arn arn:aws:sns:************************ --auto-scaling-group 'MYTEST-SG' --notification-types autoscaling:EC2_INSTANCE_LAUNCH, autoscaling:EC2_INSTANCE_TERMINATE, autoscaling:EC2_INSTANCE_TERMINATE_ERROR, autoscaling:EC2_INSTANCE_LAUNCH_ERROR
    $ OK-Put Notification Configuration
    </pre>

    ###Considerations When Scaling LAMP-type Servers###

    When migrating a single-server LAMP app to an autoscaling deployment often
    takes some planning and changing some of the configuration a bit. For
    example, you'll need to store shared data, particularly sessions, on a
    separate instance, or better yet, use Amazon's shared MySQL cluster, called
    RDS.

    By default, PHP stores sessions on disk as files, but that won't work in
    your example, because User A's session token got written to the first
    server, while User B's is on server 2. But on their second or third request,
    the user's request can be served by a different server instance, so they'll
    instantly be logged out. That's [why you'll want to use the database
    sessions][link30], and use the same connection info from all your instances
    to a single database server or RDS.

    If you enable [Application-Controlled Session Stickiness][link25];

    > The load balancer uses a special cookie to associate the session with the
    > original server that handled the request, but follows the lifetime of the
    > application-generated cookie corresponding to the cookie name specified in
    > the policy configuration. The load balancer only inserts a new stickiness
    > cookie if the application response includes a new application cookie. The
    > load balancer stickiness cookie does not update with each request. If the
    > application cookie is explicitly removed or expires, the session stops
    > being sticky until a new application cookie is issued.

    > If an application server fails or is removed, the load balancer will try
    > to route the sticky session to another healthy application server. The
    > load balancer will try to stick to new healthy application server and
    > continue routing to currently stick application server even after the
    > failed application server comes back. However, it is up to the new
    > application server on how it'll respond to a request which it has not seen
    > previously.

    ... so if your PHP app has a specific cookie it uses to manage settings, the ELB
    will make sure the request is passed to the same server that issued the
    request.

    Your AMI should only have Apache & PHP on it, and each instance will have the
    same, shared MySQL server or RDS connection info, baked into the AMI. If
    users can upload images, you'll need to move them from the instance to a
    shared server (rsync) or S3 bucket (cron script), and map that origin as your
    CloudFront endpoint for caching ...

    \- OR \-

    ... you could just have each instance upload the shared-data directly to a
    location that all the instances reference like S3. While AWS does a lot of
    the heavy lifting it is expected that you at least understand how your
    infrastructure is configured to achieve the desired result.

    There are, of course, other ways of achieving the same end result, but the
    above suggestions are the most common, easiest techniques within Amazon Web
    Services.

    ###Points To Note###

    * Your original instance doesn't have anything to do with Auto Scaling. It
    lives outside of your Auto Scaling setup and will not be touched. When Auto
    Scaling launches a new instance, it will always use the AMI you have defined
    in the launch configuration. That AMI never changes. You simply get a copy
    of the data from that point in time whenever an instance is launched.
    * Each instance is entirely separate. There is no connection between them. If
    you make changes on one instance, you will need to walk through all of them
    manually. These changes will not be persistent though. When a new instance
    is launched, it will be a copy of the original AMI. So you will probably
    want to replace the AMI instead. If you have some application code that can
    change, you might want to consider building an AMI that can fetch everything
    on boot, and maybe also react on changes somehow. If you can avoid having to
    replace the AMI "all the time", that is going to make it easier for you.
    * You don't need an Elastic IP when you are using Elastic Load Balancing.
    * When you have a new AMI, you will need to create a new launch configuration
    and update the Auto Scaling group. You can then, say, double the capacity,
    wait for the new instances to become available, and finally have the old
    instances terminated.

    <div markdown="1" class="post-footnotes">
    1. [AWS Developer Tools][awsdevelopertools]
    2. [Ubuntu developers: Eric Hammond: Installing AWS Command Line Tools from Amazon Downloads][link1]
    3. [EC2StartersGuide][ubuntuec2guide]
    4. [Autoscaling with EC2][link2]
    5. [Installing AWS Command Line Tools from Amazon Downloads][link6]
    6. [Amazon Elastic Load Balancer Setup][link7]
    7. [Autoscaling your website with Amazon Web Services – Part 1][link8]
    8. [Autoscaling your website with Amazon Web Services – Part 2][link9]
    9. [Create Your Own AMIs][link10]
    10. [Chef, EC2 Auto Scaling, and Spot Instances for Fun and Profit][link11]
    11. [Use Domain Names with Elastic Load Balancing][link14]
    12. [Autoscaling Documentation - Amazon AWS][link15]
    13. [Amazon EC2 Instance Types][link16]
    14. [Setting Up the Amazon EC2 Command Line Tools][link17]
    15. [Autoscaling Documentation | Set the AWS_CREDENTIAL_FILE environment variable][link18]
    16. [Register EC2 Instances to more than one Elastic Load Balancer][link19]
    17. [Amazon AutoScaling Documentation | Scaling Based On Demand][link23]
    18. [Amazon AutoScaling Documentation | Cooldown Period][link24]
    19. [Enable Application-Controlled Session Stickiness][link25]
    20. [Why Is It Good To Save Session in Database?][link30]
    21. [Understanding autoscaled instances][link33]
    </div>

    [aws]: https://aws.amazon.com/
    [awsconsole]: aws.amazon.com/console/
    [awsdevelopertools]: http://aws.amazon.com/developertools
    [ubuntuec2guide]: https://help.ubuntu.com/community/EC2StartersGuide

    [link1]: http://www.linux-support.com/cms/ubuntu-developers-eric-hammond-installing-aws-command-line-tools-from-amazon-downloads/
    [link2]: http://kkpradeeban.blogspot.com/2011/01/auto-scaling-with-amazon-ec2.html
    [link3]: http://aws.amazon.com/developertools/351
    [link4]: http://aws.amazon.com/developertools/2535
    [link5]: http://aws.amazon.com/developertools/2536
    [link6]: http://alestic.com/2012/09/aws-command-line-tools
    [link7]: http://www.loudsteve.com/2009/05/20/amazon-elastic-load-balancer-setup/
    [link8]: http://www.cardinalpath.com/autoscaling-your-website-with-amazon-web-services-part-1/
    [link9]: http://www.cardinalpath.com/autoscaling-your-website-with-amazon-web-services-part-2/
    [link10]: http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/creating-an-ami.html
    [link11]: http://engineering.gnip.com/chef-ec2-auto-scaling-and-spot-instances-for-fun-and-profit/
    [link12]: https://www.google.com/search?q=setting+up+amazon+api+tools&amp;aq=f&amp;oq=setting+up+amazon+api+tools
    [link13]: http://packages.ubuntu.com/search?keywords=ec2-api-tools
    [link14]: http://docs.aws.amazon.com/ElasticLoadBalancing/latest/DeveloperGuide/using-domain-names-with-elb.html
    [link15]: http://aws.amazon.com/documentation/autoscaling/
    [link16]: http://aws.amazon.com/ec2/instance-types/
    [link17]: http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/SettingUp_CommandLine.html
    [link18]: http://docs.aws.amazon.com/AutoScaling/latest/GettingStartedGuide/SetupCLI.html#AS_Generic_GSG_Configure
    [link19]: http://www.andrew-kirkpatrick.com/2011/09/register-ec2-instances-to-more-than-one-elastic-load-balancer/
    [link20]: http://docs.aws.amazon.com/ElasticLoadBalancing/latest/DeveloperGuide/TerminologyandKeyConcepts.html#healthcheck
    [link21]: http://docs.aws.amazon.com/ElasticLoadBalancing/latest/DeveloperGuide/TerminologyandKeyConcepts.html#registerinstance
    [link22]: http://aws.amazon.com/developertools/2534
    [link23]: http://docs.aws.amazon.com/AutoScaling/latest/DeveloperGuide/as-scale-based-on-demand.html
    [link24]: http://docs.aws.amazon.com/AutoScaling/latest/DeveloperGuide/AS_Concepts.html#Cooldown
    [link25]: http://docs.aws.amazon.com/ElasticLoadBalancing/latest/DeveloperGuide/US_StickySessions.html#US_EnableStickySessionsAppCookies
    [link26]: http://docs.aws.amazon.com/gettingstarted/latest/awsgsg-intro/getstarted.html
    [link27]: http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/Instances.html
    [link28]: http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/AMIs.html
    [link30]: http://stackoverflow.com/questions/13911210/why-is-it-good-save-session-in-database
    [link31]: http://www.ubuntu.com/cloud/public-cloud/guest
    [link32]: http://docs.aws.amazon.com/ElasticLoadBalancing/latest/DeveloperGuide/gs-ec2classic.html
    [link33]: https://forums.aws.amazon.com/thread.jspa?threadID=122659



