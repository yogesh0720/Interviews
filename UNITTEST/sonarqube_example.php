<?php

/**
 * SonarQube - Code Quality and Security Analysis Platform
 * 
 * WHEN TO USE:
 * - Continuous code quality monitoring
 * - Security vulnerability detection
 * - Technical debt management
 * - Code review process
 * - Compliance requirements
 * 
 * WHY USE:
 * - Comprehensive quality metrics
 * - Security vulnerability detection
 * - Code smell identification
 * - Technical debt tracking
 * - Integration with CI/CD
 * - Multi-language support
 * - Historical trend analysis
 */

class PaymentProcessor
{
    private string $apiKey;
    private array $config;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey; // SonarQube: Store sensitive data securely
        $this->config = $this->loadConfig();
    }

    /**
     * SonarQube will analyze this method for:
     * - Complexity
     * - Security issues
     * - Code smells
     * - Duplicated code
     */
    public function processPayment(array $paymentData): array
    {
        // SonarQube: Validate input parameters
        if (empty($paymentData['amount']) || $paymentData['amount'] <= 0) {
            throw new InvalidArgumentException('Invalid payment amount');
        }

        // SonarQube: Avoid hardcoded values
        $maxAmount = $this->config['max_payment_amount'] ?? 10000;

        if ($paymentData['amount'] > $maxAmount) {
            throw new InvalidArgumentException('Payment amount exceeds limit');
        }

        // SonarQube: Use secure random for transaction IDs
        $transactionId = bin2hex(random_bytes(16));

        // SonarQube: Log security events
        $this->logPaymentAttempt($paymentData, $transactionId);

        return [
            'transaction_id' => $transactionId,
            'status' => 'processed',
            'amount' => $paymentData['amount'],
            'timestamp' => time()
        ];
    }

    private function loadConfig(): array
    {
        // SonarQube: Handle file operations safely
        $configFile = __DIR__ . '/config.json';

        if (!file_exists($configFile)) {
            return ['max_payment_amount' => 5000];
        }

        $content = file_get_contents($configFile);
        return json_decode($content, true) ?? [];
    }

    private function logPaymentAttempt(array $data, string $transactionId): void
    {
        // SonarQube: Don't log sensitive information
        $logData = [
            'transaction_id' => $transactionId,
            'amount' => $data['amount'],
            'timestamp' => date('Y-m-d H:i:s')
            // Note: Not logging full payment data for security
        ];

        error_log('Payment processed: ' . json_encode($logData));
    }
}

// Example of code issues SonarQube would detect:
class ProblematicCode
{
    // SonarQube: Unused private method
    private function unusedMethod(): void
    {
        // Dead code
    }

    // SonarQube: High cyclomatic complexity
    public function complexMethod($input): string
    {
        if ($input > 10) {
            if ($input < 20) {
                if ($input % 2 === 0) {
                    return 'even';
                } else {
                    return 'odd';
                }
            } else {
                return 'high';
            }
        } else {
            return 'low';
        }
    }

    // SonarQube: Duplicated code block
    public function duplicatedLogic1($data): array
    {
        $result = [];
        foreach ($data as $item) {
            if ($item > 0) {
                $result[] = $item * 2;
            }
        }
        return $result;
    }

    // SonarQube: Duplicated code block (same as above)
    public function duplicatedLogic2($data): array
    {
        $result = [];
        foreach ($data as $item) {
            if ($item > 0) {
                $result[] = $item * 2;
            }
        }
        return $result;
    }
}
