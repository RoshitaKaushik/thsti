using System;
using System.IO;
using System.Security.Cryptography;
using System.Text;

namespace ThstiServer.Utils
{
    public class CryptoHelper
    {
        private readonly byte[] _key;

        public CryptoHelper(string secret)
        {
            // Compute SHA-256 hash to ensure a strict 32-byte key for AES-256
            using (var sha256 = SHA256.Create())
            {
                _key = sha256.ComputeHash(Encoding.UTF8.GetBytes(secret));
            }
        }

        public string Encrypt(string plainText)
        {
            if (string.IsNullOrEmpty(plainText)) return null;

            using (Aes aesAlg = Aes.Create())
            {
                aesAlg.Key = _key;
                aesAlg.Mode = CipherMode.CBC;
                aesAlg.Padding = PaddingMode.PKCS7;
                aesAlg.GenerateIV(); // Generates a random 16-byte IV

                byte[] encryptedBytes;

                using (var encryptor = aesAlg.CreateEncryptor(aesAlg.Key, aesAlg.IV))
                using (var msEncrypt = new MemoryStream())
                {
                    using (var csEncrypt = new CryptoStream(msEncrypt, encryptor, CryptoStreamMode.Write))
                    using (var swEncrypt = new StreamWriter(csEncrypt))
                    {
                        swEncrypt.Write(plainText);
                    }
                    encryptedBytes = msEncrypt.ToArray();
                }

                // Combine exactly like crypto.js: IV + Ciphertext
                byte[] combined = new byte[aesAlg.IV.Length + encryptedBytes.Length];
                Buffer.BlockCopy(aesAlg.IV, 0, combined, 0, aesAlg.IV.Length);
                Buffer.BlockCopy(encryptedBytes, 0, combined, aesAlg.IV.Length, encryptedBytes.Length);

                return Convert.ToBase64String(combined);
            }
        }

        public string Decrypt(string base64Combined)
        {
            if (string.IsNullOrEmpty(base64Combined)) return null;

            byte[] combined;
            try {
                combined = Convert.FromBase64String(base64Combined);
            } catch {
                return null;
            }

            if (combined.Length < 16) return null; // Invalid wrapper length

            try
            {
                using (Aes aesAlg = Aes.Create())
                {
                    aesAlg.Key = _key;
                    aesAlg.Mode = CipherMode.CBC;
                    aesAlg.Padding = PaddingMode.PKCS7;

                    // Extract IV
                    byte[] iv = new byte[16];
                    Buffer.BlockCopy(combined, 0, iv, 0, 16);
                    aesAlg.IV = iv;

                    // Extract Ciphertext
                    byte[] cipherText = new byte[combined.Length - 16];
                    Buffer.BlockCopy(combined, 16, cipherText, 0, cipherText.Length);

                    using (var decryptor = aesAlg.CreateDecryptor(aesAlg.Key, aesAlg.IV))
                    using (var msDecrypt = new MemoryStream(cipherText))
                    using (var csDecrypt = new CryptoStream(msDecrypt, decryptor, CryptoStreamMode.Read))
                    using (var srDecrypt = new StreamReader(csDecrypt))
                    {
                        return srDecrypt.ReadToEnd();
                    }
                }
            } 
            catch (Exception)
            {
                return null;
            }
        }
    }
}
