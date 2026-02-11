<?php

/**
 * I – Interface Segregation Principle (ISP)
 * 
 * WHEN TO USE:
 * - When interfaces become large, bloated, or partially implemented
 * - When classes throw "not supported" exceptions
 * 
 * WHY TO USE:
 * - Keep implementations clean, focused, and flexible
 * - Clients shouldn't depend on methods they don't use
 */

// ❌ BAD: Fat interface forces unnecessary implementations
interface MachineBad
{
    public function print();
    public function scan();
    public function fax();
}

class OldPrinter implements MachineBad
{
    public function print()
    {
        echo "Printing\n";
    }

    public function scan()
    {
        throw new Exception("Not supported");
    }

    public function fax()
    {
        throw new Exception("Not supported");
    }
}

// ✅ GOOD: Segregated interfaces
interface Printer
{
    public function print($document);
}

interface Scanner
{
    public function scan();
}

interface Fax
{
    public function fax($document);
}

class BasicPrinter implements Printer
{
    public function print($document)
    {
        echo "Printing: $document\n";
    }
}

class MultiFunctionPrinter implements Printer, Scanner, Fax
{
    public function print($document)
    {
        echo "MFP Printing: $document\n";
    }

    public function scan()
    {
        echo "MFP Scanning document\n";
        return "scanned_document.pdf";
    }

    public function fax($document)
    {
        echo "MFP Faxing: $document\n";
    }
}

// Usage
$basicPrinter = new BasicPrinter();
$basicPrinter->print("report.pdf");

$mfp = new MultiFunctionPrinter();
$mfp->print("contract.pdf");
$scanned = $mfp->scan();
$mfp->fax($scanned);
