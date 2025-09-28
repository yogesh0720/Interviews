<?php
function reverseUtf8String(string $str): string
{
    // Split into array of Unicode characters
    $chars = preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
    return implode('', array_reverse($chars));
}

// Example
echo reverseUtf8String("भारत मेरा देश है") . PHP_EOL; // outputs ैह शेद ारेम तराभ
echo reverseUtf8String("नमस्ते") . PHP_EOL; // outputs ेत्समन
echo reverseUtf8String("你好世界") . PHP_EOL; // outputs 界世好你
