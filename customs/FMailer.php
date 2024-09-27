<?php
namespace app\customs;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Transport\NativeTransportFactory;
use Symfony\Component\Mailer\Transport\NullTransportFactory;
use Symfony\Component\Mailer\Transport\SendmailTransportFactory;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransportFactory;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mailer\Bridge\Amazon\Transport\SesTransportFactory;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailTransportFactory;
use Symfony\Component\Mailer\Bridge\Infobip\Transport\InfobipTransportFactory;
use Symfony\Component\Mailer\Bridge\Mailchimp\Transport\MandrillTransportFactory;
use Symfony\Component\Mailer\Bridge\Mailgun\Transport\MailgunTransportFactory;
use Symfony\Component\Mailer\Bridge\Mailjet\Transport\MailjetTransportFactory;
use Symfony\Component\Mailer\Bridge\OhMySmtp\Transport\OhMySmtpTransportFactory;
use Symfony\Component\Mailer\Bridge\Postmark\Transport\PostmarkTransportFactory;
use Symfony\Component\Mailer\Bridge\Sendgrid\Transport\SendgridTransportFactory;
use Symfony\Component\Mailer\Bridge\Sendinblue\Transport\SendinblueTransportFactory;
use Yii;
use app\models\ConfigSearch;
use yii\symfonymailer\Mailer;

class FMailer extends Mailer
{
    private ?TransportInterface $_transport = null;
    public ?Transport $transportFactory = null;

    /**
     * @inheritdoc
     */
    public function setTransport($transport): void
    {
        $data = ConfigSearch::getData();
        $config = json_decode($data['config']);
        $dsn['dsn'] = "smtp://{$config->smtp_user}:{$config->smtp_password}@{$config->smtp_host}:{$config->smtp_port}";
        $this->_transport = $this->createTransport($dsn);
    }

    /**
     * @inheritdoc
     */
    private function getTransportFactory(): Transport
    {
        if (isset($this->transportFactory)) {
            return $this->transportFactory;
        }

        // Use the Yii DI container, if available.
        if (isset(Yii::$container)) {
            $factories = [];
            foreach ([
                NullTransportFactory::class,
                SendmailTransportFactory::class,
                EsmtpTransportFactory::class,
                NativeTransportFactory::class,
                SesTransportFactory::class,
                GmailTransportFactory::class,
                InfobipTransportFactory::class,
                MandrillTransportFactory::class,
                MailgunTransportFactory::class,
                MailjetTransportFactory::class,
                OhMySmtpTransportFactory::class,
                PostmarkTransportFactory::class,
                SendgridTransportFactory::class,
                SendinblueTransportFactory::class,
            ] as $factoryClass) {
                if (!class_exists($factoryClass)) {
                    continue;
                }
                $factories[] = Yii::$container->get($factoryClass);
            }
        } else {
            $factories = Transport::getDefaultFactories();
        }

        /** @psalm-var array<array-key, \Symfony\Component\Mailer\Transport\TransportFactoryInterface> $factories */
        return new Transport($factories);
    }

    /**
     * @inheritdoc
     */
    private function createTransport(array $config = []): TransportInterface
    {
        $transportFactory = $this->getTransportFactory();
        if (array_key_exists('dsn', $config)) {
            if (is_string($config['dsn'])) {
                $transport = $transportFactory->fromString($config['dsn']);
            } else {
                $transport = $transportFactory->fromDsnObject($config['dsn']);
            }
        } elseif (array_key_exists('scheme', $config) && array_key_exists('host', $config)) {
            $dsn = new Dsn(
                $config['scheme'],
                $config['host'],
                $config['username'] ?? '',
                $config['password'] ?? '',
                $config['port'] ?? null,
                $config['options'] ?? [],
            );
            $transport = $transportFactory->fromDsnObject($dsn);
        } else {
            throw new InvalidConfigException('Transport configuration array must contain either "dsn", or "scheme" and "host" keys.');
        }
        return $transport;
    }
}