<?php
// Write down to create diagram
// PHP Monolith architecture with EC2 instance
// document generation
//  Error handing
// Need to migrate php zend framwork to serveless architecture aws lammda

// New php framework suggestion will accept any feedback.

/*
Write down to create a diagram. PHP Monolith architecture with EC2 instance. document generation. Error handling. Need to migrate the core PHP or Zend framework to a serverless architecture, AWS Lambda. Need a cost-effective solution. Any miscroservice PHP framework suggestion will accept.
*/





Sequence Flow:
1. Users → ALB (Load Balancer)
2. ALB → EC2 Monolith
3. EC2 → S3 (File Storage)
4. DocGen EC2 → S3
5. EC2 → RDS MySQL
6. EC2 → Redis (Sessions)
7. Facade → Lambda Microservices (New Path)
8. Facade → EC2 Monolith (Fallback)
9. Auth Service → Aurora
10. Customer Service → Aurora
11. Lambda Group → S3
12. Lambda Group → SQS
13. SQS → DocGen Worker
13A. SQS → Fargate (Optional)
14. DocGen Worker → S3
14A. Fargate → S3 (Optional)
15. Lambda Group → EventBridge/SNS
16. Monitoring → Lambda Group


NOTE: Tightly coupled monolith
Application logic + document generation + workers in a single codebase.
Denser resource usage (CPU/Memory)
Deployment risk higher
Scaling limited by EC2 instance size


"From Old to New: A Migration Story"
3 Main Parts:
1. LEFT (Current): Old monolith system - everything runs on one big server
2. MIDDLE (Transition): Smart router that gradually sends traffic to new system
3. RIGHT (Future): New serverless system - broken into small, independent pieces
The Migration Strategy:
* Strangler Facade Pattern: Like renovating a house room by room while still living in it
* Route new features → serverless (right side)
* Keep old features → monolith (left side) until migrated
* Gradually move everything from left to right
Key Benefits:
* Zero downtime - users never notice the change
* Risk reduction - can rollback if issues occur
* Team productivity - can work on new features while migrating old ones
Simple Analogy:Think of it like replacing a old bridge while people are still using it - you build the new bridge piece by piece, redirect traffic gradually, and only remove the old parts when the new ones are proven to work.
The Numbers (1-16) show the data flow sequence through both systems during the transition period.