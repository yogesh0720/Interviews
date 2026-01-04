One exercise for Cost Calculation. Please refer below to check

Region: Mumbai

EC2 configuration:

- Instance Type: m6a.large
- Storage Volune: 30 GB
- Minimum: 2 instances
- Average: 4 instances
- Peak: 8 instances (2 hours/day)

- Instance Type: t4g.small
- Storage Volune: 30 GB

Load balancer

- Application load balancer
- Process Bytes 1000 GB per month
- Average number of new connection 10 per seconds
- Average connection duration : 5
- Average number of rule evaluationis per request:10

Add RDS MySQL:

- Instance: db.t3.medium
- Storage: 100GB General Purpose SSD
- Multi-AZ deployment

CDN - Cloudfront

- Data Transfer to Internet 1000GB
- Data transfer to origin 100GB
- Number of requests HTTPS 10000

Network VPC

- NAT Gateway 1
- Data transfer: 100GB
- Public IP Address : 1

Backup

- Daily once for EC2 and RDS
