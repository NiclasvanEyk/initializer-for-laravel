<?php

namespace Domains\CreateProjectForm;

use Domains\CreateProjectForm\Sections\Authentication;
use Domains\CreateProjectForm\Sections\Cache;
use Domains\CreateProjectForm\Sections\Database;
use Domains\CreateProjectForm\Sections\DevelopmentTools;
use Domains\CreateProjectForm\Sections\Metadata;
use Domains\CreateProjectForm\Sections\Octane;
use Domains\CreateProjectForm\Sections\Payment;
use Domains\CreateProjectForm\Sections\Queue;
use Domains\CreateProjectForm\Sections\Search;
use Domains\CreateProjectForm\Sections\Storage;
use Domains\CreateProjectForm\Sections\Testing;

class CreateProjectForm
{
    public function __construct(
        public Metadata $metadata,
        public Authentication $authentication,
        public Database $database,
        public Cache $cache,
        public Queue $queue,
        public Search $search,
        public DevelopmentTools $developmentTools,
        public Testing $testing,
        public Payment $payment,
        public Storage $storage,
        public Octane $octane,
    ) {
    }
}
